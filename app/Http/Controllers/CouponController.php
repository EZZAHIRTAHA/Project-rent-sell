<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function validateCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string|max:50'
        ]);

        $couponCode = strtoupper(trim($request->input('coupon_code')));
        
        // Find the coupon
        $coupon = Coupon::where('code', $couponCode)->first();
        
        if (!$coupon) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid coupon code'
            ]);
        }

        // Get order amount from request (optional)
        $orderAmount = $request->input('order_amount', 0);
        
        // Check if coupon is valid
        if (!$coupon->isValid($orderAmount)) {
            $message = 'Coupon is not valid';
            
            // Provide specific error messages
            if (!$coupon->is_active) {
                $message = 'Coupon is inactive';
            } elseif ($coupon->expires_at && now()->isAfter($coupon->expires_at)) {
                $message = 'Coupon has expired';
            } elseif ($coupon->starts_at && now()->isBefore($coupon->starts_at)) {
                $message = 'Coupon is not yet active';
            } elseif ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
                $message = 'Coupon usage limit exceeded';
            } elseif ($coupon->minimum_amount && $orderAmount < $coupon->minimum_amount) {
                $message = 'Order amount does not meet minimum requirement of $' . $coupon->minimum_amount;
            }
            
            return response()->json([
                'valid' => false,
                'message' => $message
            ]);
        }
        
        // Calculate discount
        $discountAmount = $coupon->calculateDiscount($orderAmount);
        
        return response()->json([
            'valid' => true,
            'coupon' => [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'name' => $coupon->name,
                'type' => $coupon->type,
                'discount_percentage' => $coupon->discount_percentage,
                'discount_amount' => $coupon->discount_amount,
            ],
            'calculated_discount' => $discountAmount,
            'discount_percentage' => $coupon->type === 'percentage' ? $coupon->discount_percentage : null,
            'message' => 'Coupon applied successfully!'
        ]);
    }

    /**
     * Apply coupon to order (call this when order is placed)
     */
    public function applyCoupon($couponCode, $orderAmount)
    {
        $coupon = Coupon::where('code', strtoupper(trim($couponCode)))->first();
        
        if ($coupon && $coupon->isValid($orderAmount)) {
            $discount = $coupon->calculateDiscount($orderAmount);
            $coupon->incrementUsage();
            
            return [
                'success' => true,
                'discount' => $discount,
                'coupon' => $coupon
            ];
        }
        
        return [
            'success' => false,
            'discount' => 0,
            'coupon' => null
        ];
    }
}