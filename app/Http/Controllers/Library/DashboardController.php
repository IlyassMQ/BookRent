<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Stock;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $library = auth()->user()->library;

        if (!$library) {
            return redirect()->route('library.create');
        }

        $books = Book::where('library_id', $library->id)->latest()->get();

        $stocks = Stock::with('book')
            ->where('library_id', $library->id)
            ->get();

        return view('library.dashboard', compact('library','books','stocks'));
    }
}
