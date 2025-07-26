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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            // $table->unsignedBigInteger('cart_id');
            // $table->foreign('cart_id')->references('id')->on('cart');
            $table->string('address');
            $table->string('note')->nullable();        
            $table->float('subtotal', 2);
            $table->float('total', 2);
            $table->unsignedInteger('shipping_fee')->default(0);
            $table->string('status')->nullable();
            //$table->unsignedBigInteger('shipper_id');
            //$table->foreign('shipper_id')->references('id')->on('shippers');
            //$table->string('payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
