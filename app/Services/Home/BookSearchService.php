<?php

namespace App\Services\Home;

use App\Models\Book;

class BookSearchService
{
    public function search(array $filters)
    {
        $books = Book::with(['category', 'stocks'])->paginate(12);

    if (!empty($filters['search'])) {
        $search = $filters['search'];

        $books = Book::with(['category', 'stocks'])
            ->where('title', 'like', "%$search%")
            ->orWhere('author', 'like', "%$search%")
            ->paginate(12);
    }

    foreach ($books as $book) {
        $book->totalStock = $book->stocks->sum('quantity');
    }

    return $books;
    }
}