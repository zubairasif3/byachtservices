<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'hourly_rate',
        'balance',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime',
        'hourly_rate' => 'decimal:2',
        'balance' => 'decimal:2',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($user) {
    //         if ($user->role_id == null) {
    //             $role = Role::where('name','Customer')->first();
    //             if ($role) {
    //                 $user->update([
    //                     'role_id' => $role->id
    //                 ]);
    //             }
    //         }
    //     });
    // }

    // Relationship: A user can have many boats
    public function boats(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CustomersBoat::class);
    }

    /**
     * Define relationship to tasks where the user is the customer.
     */
    public function tasksAsCustomer()
    {
        return $this->hasMany(Task::class, 'company_owner', 'id');
    }

    /**
     * Define relationship to tasks where the user is the worker.
     */
    public function tasksAsWorker()
    {
        return $this->hasMany(Task::class, 'done_by', 'id');
    }


    public function invoicesAsCustomer(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Invoice::class, 'customer_id');
    }

    public function invoicesAsWorker(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Invoice::class, 'worker_id');
    }


    public function financialTransactionsAsCustomer(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FinancialTransaction::class, 'customer_id');
    }

    public function totalFinancialTransactionAmountAsCustomer(): float
    {
        return $this->financialTransactionsAsCustomer()->sum('amount');
    }

    public function customer_runing_balance(): float
    {
        return $this->balance + $this->totalFinancialTransactionAmountAsCustomer();
    }

    public function financialTransactionsAsWorker(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FinancialTransaction::class, 'worker_id');
    }


}
