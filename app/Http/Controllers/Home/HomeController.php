<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Library;
use App\Services\Home\BookSearchService;
use Auth;

class HomeController extends Controller
{
    public function __construct(private BookSearchService $service) {}

    public function index()
    {
        $books = $this->service->search(request()->only(['search']));
        return view('home.index', compact('books'));
    }

    public function show(Book $book)
    {
    $book->load(['tags', 'stocks.library']);

    $book->totalStock = $book->stocks->sum('quantity');

    return view('home.show', compact('book'));
    }

    public function recommendations()
    {
        $user = Auth::user();

    $tagIds = $user->tags()->pluck('tags.id');

    $books = Book::with(['tags', 'stocks.library'])
        ->whereHas('tags', function ($q) use ($tagIds) {
            $q->whereIn('tags.id', $tagIds);
        })
        ->paginate(12);

    
    foreach ($books as $book) {
        $book->totalStock = $book->stocks->sum('quantity');
    }

    return view('home.recommendations', compact('books'));
    }

    public function nearby()
{
    $user = auth()->user();

    $books = Book::with(['stocks.library'])
        ->whereHas('stocks.library', function ($q) use ($user) {
            $q->whereRaw('LOWER(libraries.city) = ?', [strtolower($user->city)]);
        })
        ->paginate(12);

    foreach ($books as $book) {
        $book->totalStock = $book->stocks->sum('quantity');
    }

    return view('home.nearby', compact('books'));
}

    public function libraries() {
        $libraries = Library::where('status', 'approved')
        ->withCount('books')
        ->get();

    return view('home.libraries', compact('libraries'));
    }
}
