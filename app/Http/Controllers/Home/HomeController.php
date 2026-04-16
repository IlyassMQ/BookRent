<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::with(['tags','stocks.library'])->paginate(12);

        foreach ($books as $book) {
            $book->totalStock = $book->stocks->sum('quantity');
        }

        return view('home.index', compact('books'));
    }
}
