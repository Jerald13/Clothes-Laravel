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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // foreign key column
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('product_id'); // foreign key column
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('order_quantity');
            $table->decimal('order_subtotal', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
