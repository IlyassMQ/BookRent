<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
        protected $fillable = ['name', 'address', 'geo_lat', 'geo_lng', 'user_id','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
