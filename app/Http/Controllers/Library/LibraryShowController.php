<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Library;
use Illuminate\Http\Request;

class LibraryShowController extends Controller
{
     public function show(Library $library)
    {
        $library->load([
            'books.tags',
            'books.stocks'
        ]);

        foreach ($library->books as $book) {
            $book->totalStock = $book->stocks->sum('quantity');
        }

        return view('library.show', compact('library'));
    }
}
