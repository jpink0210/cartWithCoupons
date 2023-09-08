<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MartCoupon;

/**
 * pa make:seeder MartCouponSeeder
 */
class MartCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MartCoupon::upsert([
            [
                'id' => 1,
                'name' => '[茶類＆咖啡] 九月跳樓大拍賣 - 同品項「九折」優惠券',
                'type' => 'multiply',
                'discount' => 0.9
            ],
            [
                'id' => 2,
                'name' => '[茶類＆咖啡] 九月跳樓大拍賣 - 同品項折 10 元優惠券',
                'type' => 'minus',
                'discount' => 10
            ],
        ], ['id'], ['discount']);
    }
}
