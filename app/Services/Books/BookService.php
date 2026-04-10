<?php

namespace App\Services\Books;

use App\Models\Book;

class BookService
{
    public function create(array $data)
    {
        return Book::create($data);
    }

    public function update(Book $book, array $data)
    {
        $book->update($data);
    }

    public function delete(Book $book)
    {
        $book->delete();
    }
}