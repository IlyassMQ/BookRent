<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class LibraryTransactionController extends Controller
{
    public function index()
    {
        $libraryId = auth()->user()->library->id;

        $transactions = Transaction::with(['book', 'user', 'payment'])
            ->where('library_id', $libraryId)
            ->latest()
            ->get();

        return view('library.transactions.index', compact('transactions'));
    }
}
