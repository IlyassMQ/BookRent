<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Library;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $librariesCount = Library::count();
        $booksCount = Book::count();
        $transactionsCount = Transaction::count();
    
        return view('admin.dashboard',compact('booksCount', 'librariesCount', 'usersCount', 'transactionsCount'));
    }

    public function users()
    {
        $users = User::with('role')
        ->whereRelation('role', 'name', 'user')
        ->get();
        return view('admin.users', compact('users'));
    }

    public function libraries()
    {
        $libraries = Library::with('user')->get();
        return view('admin.libraries', compact('libraries'));
    }

    public function books()
    {
        $books = Book::all();
        return view('admin.books', compact('books'));
    }

    public function transactions()
    {
        $transactions = Transaction::with('user', 'book', 'library')->get();
        return view('admin.transactions', compact('transactions'));
    }
}
