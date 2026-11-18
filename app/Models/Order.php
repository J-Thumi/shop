<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'pickup_location_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'pickup_location_name',
        'pickup_location_address',
        'pickup_location_phone',
        'order_number',
        'tracking_number',
        'status',
        'payment_method',
        'payment_status',
        'subtotal',
        'total',
        'customer_note',
        'placed_at',
        'completed_at',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'total' => 'decimal:2',
            'placed_at' => 'datetime',
            'completed_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pickupLocation(): BelongsTo
    {
        return $this->belongsTo(PickupLocation::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(OrderStatusHistory::class);
    }

    public function cancellation(): HasOne
    {
        return $this->hasOne(OrderCancellation::class);
    }

    public function canBeCancelledImmediately(): bool
    {
        return in_array($this->status, ['pending', 'confirmed'], true);
    }

    public function canRequestCancellation(): bool
    {
        return in_array($this->status, [
            'processing',
            'ready_for_collection',
        ], true) && !$this->cancellation;
    }

    public function isTerminal(): bool
    {
        return in_array($this->status, ['completed', 'cancelled'], true);
    }
}