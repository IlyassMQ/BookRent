<?php
namespace App\Services\Library;

use App\Models\Book;
use App\Models\Stock;
use Illuminate\Support\Facades\Storage;

class LibraryBookService
{
    public function create($user, array $data): Book
    {
        $libraryId = $user->library->id;
        if (isset($data['image'])) {
        $path = $data['image']->store('books', 'public');
        } else {
        $path = null;
        }

        // 1) Create book
        $book = Book::create([
            'title' => $data['title'],
            'author' => $data['author'],
            'isbn' => $data['isbn'],
            'description' => $data['description'] ?? null,
            'category_id' => $data['category_id'],
            'purchase_price' => $data['purchase_price'],
            'rental_price' => $data['rental_price'],
            'library_id' => $libraryId,
            'image' => $path,
        ]);

        // 2) Create stock automatically
        Stock::create([
            'library_id' => $libraryId,
            'book_id' => $book->id,
            'quantity' => $data['quantity'],
        ]);
        $book->tags()->sync($data['tags'] ?? []);
        return $book;
    }

    public function update($user, $book, array $data)
{
    // Ownership check
    if ($book->library_id !== $user->library->id) {
        abort(403);
    }

    // handle image
    if (isset($data['image'])) {
        //delete old image
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }
        $data['image'] = $data['image']->store('books', 'public');
    }

    $book->update([
        'title' => $data['title'],
        'author' => $data['author'],
        'isbn' => $data['isbn'],
        'description' => $data['description'] ?? null,
        'category_id' => $data['category_id'],
        'purchase_price' => $data['purchase_price'],
        'rental_price' => $data['rental_price'],
        'image' => $data['image'] ?? $book->image,
    ]);
    $book->tags()->sync($data['tags'] ?? []);
    return $book;
}

    public function delete($user, $book): void
    {
    if ($book->library_id !== $user->library->id) {
        abort(403);
    }

        Stock::where('book_id', $book->id)->delete();

        $book->delete();
    
}
}