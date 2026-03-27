<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'library_id',
        'type',
        'status',
        'rental_start',
        'rental_end',
        'code_retrait'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}