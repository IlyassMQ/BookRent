<?php
namespace App\Services\Library;

use App\Models\Book;
use App\Models\Stock;

class LibraryBookService
{
    public function create($user, array $data): Book
    {
        $libraryId = $user->library->id;

        // 1) Create book
        $book = Book::create([
            'title' => $data['title'],
            'author' => $data['author'],
            'isbn' => $data['isbn'],
            'description' => $data['description'] ?? null,
            'category' => $data['category'],
            'purchase_price' => $data['purchase_price'],
            'rental_price' => $data['rental_price'],
            'library_id' => $libraryId,
        ]);

        // 2) Create stock automatically
        Stock::create([
            'library_id' => $libraryId,
            'book_id' => $book->id,
            'quantity' => $data['quantity'],
        ]);

        return $book;
    }

    public function update($user, $book, array $data)
{
    // Ownership check
    if ($book->library_id !== $user->library->id) {
        abort(403);
    }

    $book->update([
        'title' => $data['title'],
        'author' => $data['author'],
        'isbn' => $data['isbn'],
        'description' => $data['description'] ?? null,
        'category' => $data['category'],
        'purchase_price' => $data['purchase_price'],
        'rental_price' => $data['rental_price'],
    ]);

    return $book;
    }

    public function delete($user, $book): void
    {
    // Ownership check
    if ($book->library_id !== $user->library->id) {
        abort(403);
    }

        // Delete stock first
        Stock::where('book_id', $book->id)->delete();

        // Delete book
        $book->delete();
    
}
}