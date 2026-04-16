<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'library_id',
        'category_id',
        'description',
        'purchase_price',
        'rental_price',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'book_tags');
    }

    public function library()
    {
        return $this->belongsTo(Library::class);
    }
}