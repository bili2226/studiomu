<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $fillable = [
        'name',
        'description',
        'code',
        'points_required',
        'type',
        'discount_amount',
        'status',
        'stock',
    ];

    protected function casts(): array
    {
        return [
            'points_required' => 'integer',
            'discount_amount' => 'integer',
            'stock'           => 'integer',
        ];
    }

    /**
     * Scope: only active rewards.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
