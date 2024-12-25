<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'worker_id',
        'task_id',
        'invoice_date',
        'invoice_no',
        'invoice_amount',
        'paid_amount',
        'customer_variable',
        'customer_credit',
        'customer_debit',
        'balance',
    ];

    /**
     * Relationship to the User model for the customer.
     */
    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Relationship to the User model for the worker.
     */
    public function worker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'worker_id');
    }

    /**
     * Relationship to the Task model.
     */
    public function task(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    /**
     * Accessor to calculate balance dynamically if needed.
     */
    public function getBalanceAttribute()
    {
        return ($this->invoice_amount * $this->customer_variable) - $this->paid_amount - $this->customer_credit + $this->customer_debit;
    }

    public function financialTransactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FinancialTransaction::class, 'invoice_id');
    }
}
