<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\TransactionService;
use Illuminate\Http\Request;



class TransactionController extends Controller
{
    protected $service;

    public function __construct(TransactionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
    $transactions = auth()->user()
        ->transactions()
        ->with(['book', 'payment'])
        ->latest()
        ->get();

    return view('transactions.index', compact('transactions'));
    }

    public function summary(Request $request, Book $book)
{
    $quantity = max(1, (int) $request->input('quantity', 1));
    $days = max(1, (int) $request->input('days', 1));

    $type = $request->has('days') ? 'rental' : 'purchase';

    if ($type === 'purchase') {
        $unitPrice = $book->purchase_price;
    } else {
        $unitPrice = $book->rental_price * $days;
    }

    $total = $unitPrice * $quantity;

    return view('transactions.summary', compact(
        'book',
        'quantity',
        'days',
        'type',
        'unitPrice',
        'total'
    ));
}

    public function checkout(Request $request)
    {
        $book = Book::findOrFail($request->book_id);

        $quantity = (int) $request->quantity;
        $days = (int) $request->days;
        $type = $request->type;

        $transaction = app(TransactionService::class)
            ->create(auth()->user(), $book, $type, $quantity, $days);

        return redirect()->route('payment.checkout', $transaction->payment->id);
    }
}