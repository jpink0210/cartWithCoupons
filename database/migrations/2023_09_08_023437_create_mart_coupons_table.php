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
        Schema::create('mart_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('優惠券名稱');
            $table->string('type')->comment('折扣運算方式, minus or multiply');
            $table->float('discount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mart_coupons');
    }
};
