<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Payment;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function create($user, $book, string $type, int $quantity = 1, int $days = 1)
{
    return DB::transaction(function () use ($user, $book, $type, $quantity, $days) {

        $stock = Stock::where('book_id', $book->id)
            ->where('library_id', $book->library_id)
            ->lockForUpdate()
            ->first();

        if (!$stock || $stock->quantity < $quantity) {
            abort(400, 'Not enough stock');
        }

        if ($type === 'purchase') {
            $totalPrice = $book->purchase_price * $quantity;
        } else {
            $totalPrice = $book->rental_price * $days * $quantity;
        }

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'library_id' => $book->library_id,
            'type' => $type,
            'status' => 'pending',
            'quantity' => $quantity,
            'rental_start' => $type === 'rental' ? now() : null,
            'rental_end' => $type === 'rental' ? now()->addDays($days) : null,
        ]);
        

        Payment::create([
            'transaction_id' => $transaction->id,
            'provider' => 'stripe',
            'amount' => $totalPrice,
            'currency' => 'MAD',
            'status' => 'pending',
        ]);

        return $transaction;
    });
}
}