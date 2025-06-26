<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = [
            [
                'code' => 'WELCOME10',
                'name' => 'Welcome Discount',
                'description' => '10% off for new customers',
                'type' => 'percentage',
                'discount_percentage' => 10.00,
                'is_active' => true,
                'usage_limit' => 100,
                'starts_at' => Carbon::now(),
                'expires_at' => Carbon::now()->addDays(30),
            ],
            [
                'code' => 'SAVE50',
                'name' => 'Fixed Discount',
                'description' => '$50 off your order',
                'type' => 'fixed',
                'discount_amount' => 50.00,
                'minimum_amount' => 200.00,
                'is_active' => true,
                'usage_limit' => 50,
                'starts_at' => Carbon::now(),
                'expires_at' => Carbon::now()->addDays(60),
            ],
            [
                'code' => 'SUMMER25',
                'name' => 'Summer Sale',
                'description' => '25% off with maximum $100 discount',
                'type' => 'percentage',
                'discount_percentage' => 25.00,
                'maximum_discount' => 100.00,
                'minimum_amount' => 100.00,
                'is_active' => true,
                'usage_limit' => 200,
                'starts_at' => Carbon::now(),
                'expires_at' => Carbon::now()->addDays(90),
            ],
            [
                'code' => 'EXPIRED',
                'name' => 'Expired Coupon',
                'description' => 'This coupon has expired',
                'type' => 'percentage',
                'discount_percentage' => 15.00,
                'is_active' => true,
                'starts_at' => Carbon::now()->subDays(30),
                'expires_at' => Carbon::now()->subDays(1),
            ],
        ];

        foreach ($coupons as $coupon) {
            Coupon::create($coupon);
        }
    }
}