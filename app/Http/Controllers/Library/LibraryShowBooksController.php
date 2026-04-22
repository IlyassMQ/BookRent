<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class LibraryShowBooksController extends Controller
{
    public function byCategory(Category $category)
    {
        $books = Book::with(['tags','stocks.library'])
            ->where('category_id', $category->id)
            ->paginate(12);

        foreach ($books as $book) {
            $book->totalStock = $book->stocks->sum('quantity');
        }

        return view('books.category', compact('books', 'category'));
    }

    public function byAuthor($author)
    {
        $books = Book::with(['tags','stocks.library'])
            ->where('author', $author)
            ->paginate(12);

        foreach ($books as $book) {
            $book->totalStock = $book->stocks->sum('quantity');
        }

        return view('books.author', compact('books', 'author'));
    }

    public function byTag(Tag $tag)
    {
        $books = $tag->books()
            ->with(['tags','stocks.library'])
            ->paginate(12);

        foreach ($books as $book) {
            $book->totalStock = $book->stocks->sum('quantity');
        }

        return view('books.tag', compact('books', 'tag'));
    }
}
