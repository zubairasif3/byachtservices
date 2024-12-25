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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            // Foreign key for customer
            $table->unsignedBigInteger('company_owner');
            $table->foreign('company_owner')->references('id')->on('users')->onDelete('cascade');

            // Foreign key for customer boat
            $table->unsignedBigInteger('customer_boat_id');
            $table->foreign('customer_boat_id')->references('id')->on('customers_boats')->onDelete('cascade');

            // Foreign key for worker
            $table->unsignedBigInteger('done_by');
            $table->foreign('done_by')->references('id')->on('users')->onDelete('cascade');

            // Foreign key for admin or manager
            $table->unsignedBigInteger('inserted_by');
            $table->foreign('inserted_by')->references('id')->on('users')->onDelete('cascade');

            $table->date('date_done');
            $table->decimal('hourly_rate', 8, 2)->nullable();
            $table->decimal('hours', 8, 2)->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->string('ref_no')->unique()->nullable();
            $table->string('item')->nullable();
            $table->string('location')->nullable();
            $table->text('description_action')->nullable();
            $table->string('worker_type')->nullable();
            $table->text('comments')->nullable();
            $table->enum('status', ['Pending', 'In-Progress', 'Completed'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
