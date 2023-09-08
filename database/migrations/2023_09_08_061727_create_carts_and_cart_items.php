<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * pa make:migration create_carts_and_cart_items
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->boolean('checkouted')->default(0);
            $table->timestamps();
        });
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id');
            $table->foreignId('product_id');
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
        Schema::dropIfExists('carts');
        Schema::dropIfExists('cart_items');    }
};
