<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'transaction_id',
        'provider',
        'provider_payment_id',
        'amount',
        'currency',
        'status'
    ];


    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}