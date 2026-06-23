<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'starting',
        'description',
        'note',
        'slides',
        'highlights',
        'col1',
        'col2',
        'addons',
    ];

    protected $casts = [
        'slides' => 'array',
        'highlights' => 'array',
        'col1' => 'array',
        'col2' => 'array',
        'addons' => 'array',
    ];

    /**
     * Format a price string from 'k' suffix or raw numbers to 'Juta' / 'Ribu'.
     *
     * @param string|null $priceStr
     * @return string
     */
    public static function formatPrice($priceStr)
    {
        if (empty($priceStr)) {
            return '';
        }
        $clean = strtolower(trim($priceStr));
        
        // Extract numeric value from string
        if (str_ends_with($clean, 'k')) {
            $numberPart = substr($clean, 0, -1);
            $numberPart = str_replace('.', '', $numberPart);
            $val = floatval($numberPart) * 1000;
        } elseif (str_contains($clean, 'juta') || str_contains($clean, 'jt')) {
            $numberPart = str_replace(['rp', 'juta', 'jt'], '', $clean);
            $numberPart = str_replace(',', '.', $numberPart);
            $val = floatval(trim($numberPart)) * 1000000;
        } elseif (str_contains($clean, 'ribu') || str_contains($clean, 'rb')) {
            $numberPart = str_replace(['rp', 'ribu', 'rb'], '', $clean);
            $numberPart = str_replace(',', '.', $numberPart);
            $val = floatval(trim($numberPart)) * 1000;
        } else {
            // Extract only digits
            $digits = preg_replace('/[^0-9]/', '', $clean);
            $val = floatval($digits);
            if ($val == 0) {
                return $priceStr;
            }
        }
        
        $formatted = number_format($val, 0, ',', '.');
        if (str_contains($clean, 'mulai')) {
            return 'Mulai Rp ' . $formatted;
        }
        return 'Rp ' . $formatted;
    }
}

