<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use SoftDeletes;

    /**
     * Establishes a oneToMany relationship with the Transaction
     * model
     *
     * @param
     * @return
     */
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'transactions')
            ->withPivot('amount')
            ->orderByDesc('transactions.created_at');
    }
}
