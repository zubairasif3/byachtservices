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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            // Foreign keys
            $table->unsignedBigInteger('customer_id'); // Customer being billed
            $table->unsignedBigInteger('worker_id'); // Worker being paid
            $table->unsignedBigInteger('task_id'); // Related task

            // Invoice details
            $table->date('invoice_date'); // Date invoice is issued
            $table->string('invoice_no')->unique(); // Unique invoice identifier
            $table->decimal('invoice_amount', 10, 2); // Total amount of the invoice
            $table->decimal('paid_amount', 10, 2)->default(0); // Amount paid
            $table->decimal('customer_variable', 5, 2)->default(1.0); // Multiplier or discount
            $table->decimal('customer_credit', 10, 2)->default(0); // Credits applied
            $table->decimal('customer_debit', 10, 2)->default(0); // Debits added
            $table->decimal('balance', 10, 2)->default(0); // Remaining balance



            // Foreign key constraints
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('worker_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
