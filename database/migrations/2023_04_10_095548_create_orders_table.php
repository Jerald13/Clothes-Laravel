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
            $table->unsignedBigInteger('user_id'); // foreign key column
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('track_number');
            $table->decimal('order_total', 8, 2);
            $table->enum('order_status', ['new', 'pending', 'successful', 'cancelled'])->default('new');
            $table->string('shipping_address') ->nullable();
            $table->string('state') ->nullable();
            $table->string('city') ->nullable();
            $table->integer('postcode') ->nullable();
            $table->string('country')->default('Malaysia');
            $table->decimal('shipping_fee', 8, 2);
            $table->decimal('tax_rate', 8, 2);
            $table->decimal('tax_amount', 8, 2);
            $table->integer('free_gift')->nullable();
            $table->string('logistics')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
