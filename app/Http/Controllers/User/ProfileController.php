<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $transactions = Transaction::with('book', 'library')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $activeRentals = $transactions->where('type', 'rental')
                                     ->where('status', 'paid');

        $completedOrders = $transactions->where('status', 'completed')->count();
        
        $totalSpent = $transactions->sum(function($t) {
            return $t->payment->amount ?? 0;
        });

        $totalOrders = $transactions->count();
        $activeCount = $activeRentals->count();

        return view('user.dashboard', compact(
            'user',
            'transactions',
            'activeRentals',
            'totalOrders',
            'activeCount',
            'completedOrders',
            'totalSpent'
        ));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'city' => 'required|string|max:255',
        ]);

        $user->update($data);

        return redirect()->route('user.profile.edit')->with('success', 'Profile updated successfully');
    }


    public function orders()
    {
        $user = Auth::user();
        
        $transactions = Transaction::with('book', 'library', 'payment')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('user.orders', compact('transactions'));
    }

    public function showOrder(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.order-details', compact('transaction'));
    }
}