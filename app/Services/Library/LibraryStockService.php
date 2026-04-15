<?php

namespace App\Services\Library;

use App\Models\Stock;

class LibraryStockService
{
    public function add($user, array $data): void
    {
        $libraryId = $user->library->id;

        $stock = Stock::where('library_id', $libraryId)
            ->where('book_id', $data['book_id'])
            ->first();

        if ($stock) {
            $stock->increment('quantity', $data['quantity']);
        } else {
            Stock::create([
                'library_id' => $libraryId,
                'book_id' => $data['book_id'],
                'quantity' => $data['quantity'],
            ]);
        }
    }

    public function update(Stock $stock, int $quantity): void
    {
        $stock->update(['quantity' => $quantity]);
    }

    public function delete(Stock $stock): void
    {
        $stock->delete();
    }
}