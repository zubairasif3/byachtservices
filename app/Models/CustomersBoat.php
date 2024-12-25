<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomersBoat extends Model
{
    protected $fillable = [
        'name',
        'user_id',
    ];

    // Relationship: A boat belongs to a user
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Task::class, 'customer_boat_id');
    }

}
