<?php

namespace App\Services\Books;

use App\Models\Book;

class BookService
{
    public function create(array $data)
    {
        $book = Book::create($data);
        $book->tags()->sync($data['tags'] ?? []);
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