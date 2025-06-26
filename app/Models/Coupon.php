<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'type',
        'discount_percentage',
        'discount_amount',
        'minimum_amount',
        'maximum_discount',
        'is_active',
        'usage_limit',
        'used_count',
        'starts_at',
        'expires_at',
    ];

    protected $casts = [
        'discount_percentage' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'minimum_amount' => 'decimal:2',
        'maximum_discount' => 'decimal:2',
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    /**
     * Check if coupon is valid
     */
    public function isValid($orderAmount = 0)
    {
        // Check if coupon is active
        if (!$this->is_active) {
            return false;
        }

        // Check if coupon has started
        if ($this->starts_at && Carbon::now()->isBefore($this->starts_at)) {
            return false;
        }

        // Check if coupon has expired
        if ($this->expires_at && Carbon::now()->isAfter($this->expires_at)) {
            return false;
        }

        // Check usage limit
        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            return false;
        }

        // Check minimum amount
        if ($this->minimum_amount && $orderAmount < $this->minimum_amount) {
            return false;
        }

        return true;
    }

    /**
     * Calculate discount amount
     */
    public function calculateDiscount($orderAmount)
    {
        if (!$this->isValid($orderAmount)) {
            return 0;
        }

        if ($this->type === 'percentage') {
            $discount = ($orderAmount * $this->discount_percentage) / 100;
            
            // Apply maximum discount limit if set
            if ($this->maximum_discount && $discount > $this->maximum_discount) {
                $discount = $this->maximum_discount;
            }
            
            return $discount;
        }

        if ($this->type === 'fixed') {
            return min($this->discount_amount, $orderAmount);
        }

        return 0;
    }

    /**
     * Increment usage count
     */
    public function incrementUsage()
    {
        $this->increment('used_count');
    }

    /**
     * Scope for active coupons
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for valid coupons (not expired)
     */
    public function scopeValid($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', Carbon::now());
        })->where(function ($q) {
            $q->whereNull('starts_at')
              ->orWhere('starts_at', '<=', Carbon::now());
        });
    }
}