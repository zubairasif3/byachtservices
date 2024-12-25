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
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('customer_id'); // Customer involved in the transaction
            $table->unsignedBigInteger('worker_id')->nullable(); // Worker involved (optional)
            $table->unsignedBigInteger('task_id')->nullable(); // Related task (optional)
            $table->unsignedBigInteger('invoice_id')->nullable(); // Related invoice (optional)

            // Transaction details
            $table->date('bank_date'); // Date of the transaction
            $table->string('bank_ref')->nullable(); // Bank reference number
            $table->string('supplier')->nullable(); // Supplier details
            $table->text('details')->nullable(); // Description of the transaction
            $table->decimal('amount', 10, 2); // Amount transacted
            $table->enum('type', ['Credit', 'Debit', 'Payment']); // Type of transaction

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('worker_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transactions');
    }
};
