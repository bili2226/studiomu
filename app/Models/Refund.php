<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable = [
        'booking_id',
        'amount',
        'bank_name',
        'account_number',
        'account_holder',
        'status',
        'processed_at',
    ];

    protected $casts = [
        'amount'       => 'integer',
        'processed_at' => 'datetime',
    ];

    /**
     * Get the booking that this refund belongs to.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
