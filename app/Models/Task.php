<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Define fillable attributes
    protected $fillable = [
        'company_owner',
        'customer_boat_id',
        'inserted_by',
        'done_by',
        'date_done',
        'hourly_rate',
        'hours',
        'total_price',
        'ref_no',
        'item',
        'location',
        'description_action',
        'worker_type',
        'comments',
        'status',
    ];

    /**
     * Relationship to the User model for the customer (company owner).
     */
    public function companyOwner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'company_owner');
    }

    /**
     * Relationship to the Boat model for the customer's boat.
     */
    public function customerBoat(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CustomersBoat::class, 'customer_boat_id');
    }

    /**
     * Relationship to the User model for the worker.
     */
    public function worker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'done_by');
    }

    /**
     * Accessor to calculate total price dynamically if needed.
     */
    public function getTotalPriceAttribute(): float|int
    {
        return $this->hourly_rate * $this->hours;
    }

    public function invoices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Invoice::class, 'task_id');
    }

    public function invoiceAmounts(): float|int
    {
        return $this->invoices->sum('paid_amount');
    }

    public function pending_amount(): float|int
    {
        return $this->total_price - $this->invoiceAmounts();
    }

    public function financialTransactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FinancialTransaction::class, 'task_id');
    }
}
