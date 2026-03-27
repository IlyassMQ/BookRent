<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';

    protected $fillable = ['library_id', 'book_id', 'quantity'];


    public function library()
    {
        return $this->belongsTo(Library::class);
    }
   
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
