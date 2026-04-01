<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::with('tags')->paginate(12);
        return view('home.index', compact('books'));
    }
}
