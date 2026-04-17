<?php

namespace App\Services\Home;

use App\Models\Book;

class BookSearchService
{
    public function search(array $filters)
    {
        $query = Book::with(['tags', 'stocks.library']);

        if (!empty($filters['search'])) {
            $search = $filters['search'];

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($q2) use ($search) {
                  $q2->where('name', 'like', "%{$search}%");
              });
                  
            });
        }

        $books = $query->paginate(12)->withQueryString();

        foreach ($books as $book) {
            $book->totalStock = $book->stocks->sum('quantity');
        }

        return $books;
    }
}