<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Product::upsert([
            [
                'id' => 1,
                'title' => '牙買加 藍山 水洗 咖啡豆',
                'price' => 900,
                'quantity' => 150
            ],
            [
                'id' => 2,
                'title' => '茶裏王 - 台灣綠茶',
                'price' => 20,
                'quantity' => 10000
            ],
            [
                'id' => 3,
                'title' => '瓜地馬拉 拉米尼塔 花神 咖啡豆',
                'price' => 350,
                'quantity' => 200
            ],
            [
                'id' => 4,
                'title' => '烏干達 布吉蘇 AA 咖啡豆',
                'price' => 450,
                'quantity' => 330
            ],
            [
                'id' => 5,
                'title' => '印尼 曼特寧 精選G1 一磅裝 咖啡豆',
                'price' => 400,
                'quantity' => 100
            ],
            [
                'id' => 6,
                'title' => '巴西 摩吉安娜產區 COE 冠軍莊園 皇后莊園 100% 黃波旁 咖啡豆',
                'price' => 450,
                'quantity' => 50
            ],
            [
                'id' => 7,
                'title' => '哥倫比亞 精選 咖啡豆 一磅裝 超值優惠活動 優惠價回饋 咖啡豆',
                'price' => 330,
                'quantity' => 200
            ],
            [
                'id' => 8,
                'title' => '薩爾瓦多 APANECA-ILAMATEPEC 山脈 藍絲帶莊園 蜜處理 咖啡豆',
                'price' => 290,
                'quantity' => 700
            ],
            [
                'id' => 9,
                'title' => '經典曼巴 特調配方 一磅裝｜咖啡豆',
                'price' => 200,
                'quantity' => 600
            ],
            [
                'id' => 10,
                'title' => '克羅埃西亞 聖圖阿里歐莊園 愛情靈藥 紅波旁 日曬 咖啡豆',
                'price' => 480,
                'quantity' => 400
            ],
        ], ['id'], ['price', 'quantity']);
    }
}
