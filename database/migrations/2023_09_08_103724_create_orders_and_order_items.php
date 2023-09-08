<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('cart_id')->constrained('carts');
            $table->boolean('is_shipped')->default(0);
            $table->integer('total')->comment("訂單 - 總金額");
            $table->timestamps();
        });
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('product_id');
            $table->integer('price')->comment("商品單價");
            $table->integer('quantity')->comment("數量");
            $table->foreignId('mart_coupon_id')->nullable()->default(0)->comment("優惠券 id");
            $table->integer('discount_amount')->nullable()->default(0)->comment("單項 - 折扣金額");
            $table->integer('total')->comment("單項 - 總計金額");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
    }
};
