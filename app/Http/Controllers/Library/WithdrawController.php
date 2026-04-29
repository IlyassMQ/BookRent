<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index()
    {
        return view('library.withdraw.index');
    }

    public function search(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $libraryId = auth()->user()->library->id;

        $transaction = Transaction::with(['book', 'user', 'payment'])
            ->where('code_retrait', $request->code)
            ->where('library_id', $libraryId)
            ->first();

        if (!$transaction) {
            return redirect()->route('library.withdraw.index')->with('error', 'Invalid code');
        }

        return view('library.withdraw.index', compact('transaction'));
    }

    public function confirm(Request $request)
    {
        $transaction = Transaction::where('code_retrait', $request->code)->first();

        if (!$transaction || $transaction->status !== 'paid') {
            return redirect()->route('library.withdraw.index')->with('error', 'Invalid or already used code');
        }

        $transaction->update([
            'status' => 'completed'
        ]);

        return redirect()->route('library.withdraw.index')
            ->with('success', 'Transaction completed successfully');
    }
}
