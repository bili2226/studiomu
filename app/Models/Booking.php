<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // Enable non-numeric string primary key (e.g. BOOK-XXXX)
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'service_name',
        'booking_date',
        'amount',
        'payment_method',
        'status',
        'requests',
        'snap_token',
        'discount',
        'points_used',
        'points_earned',
        'points_credited',
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'amount' => 'integer',
        'discount' => 'integer',
        'points_used' => 'integer',
        'points_earned' => 'integer',
        'points_credited' => 'boolean',
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Model boot events to handle points automatic crediting, debiting, and refunding.
     */
    protected static function booted()
    {
        static::creating(function ($booking) {
            if (in_array($booking->status, ['Confirmed', 'Completed'])) {
                if (!$booking->points_credited && $booking->points_earned > 0) {
                    $user = $booking->user;
                    if ($user) {
                        $user->increment('points', $booking->points_earned);
                        $booking->points_credited = true;
                    }
                }
            }
        });

        static::updating(function ($booking) {
            if ($booking->isDirty('status')) {
                $oldStatus = $booking->getOriginal('status');
                $newStatus = $booking->status;

                // Earning points transition
                if (in_array($newStatus, ['Confirmed', 'Completed']) && !in_array($oldStatus, ['Confirmed', 'Completed'])) {
                    if (!$booking->points_credited && $booking->points_earned > 0) {
                        $user = $booking->user;
                        if ($user) {
                            $user->increment('points', $booking->points_earned);
                            $booking->points_credited = true;
                        }
                    }
                }

                // Cancellation transition
                if ($newStatus === 'Cancelled' && $oldStatus !== 'Cancelled') {
                    // Deduct earned points if they were credited
                    if ($booking->points_credited && $booking->points_earned > 0) {
                        $user = $booking->user;
                        if ($user) {
                            $user->points = max(0, $user->points - $booking->points_earned);
                            $user->save();
                        }
                        $booking->points_credited = false;
                    }
                    
                    // Refund used points
                    if ($booking->points_used > 0) {
                        $user = $booking->user;
                        if ($user) {
                            $user->increment('points', $booking->points_used);
                        }
                    }
                }
            }
        });
    }
}
