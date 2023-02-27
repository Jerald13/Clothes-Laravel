<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("category", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->enum("status", ["active", "inactive"])->default("active"); // Set default value to 'active'
            $table->unsignedInteger("product_count")->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("category");
    }
};
