<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'worker_id',
        'task_id',
        'invoice_id',
        'bank_date',
        'bank_ref',
        'supplier',
        'details',
        'amount',
        'type',
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
     * Relationship to the Invoice model.
     */
    public function invoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
