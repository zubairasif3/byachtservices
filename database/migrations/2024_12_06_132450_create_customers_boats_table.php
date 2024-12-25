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
        Schema::create('customers_boats', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the boat
            $table->unsignedBigInteger('user_id'); // Foreign key to the user
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Cascade delete if user is deleted
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_boats');
    }
};
