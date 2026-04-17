<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\UpdateBookRequest;
use App\Http\Requests\Library\StoreLibraryBookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Library;
use App\Models\Tag;
use App\Services\Library\LibraryBookService;
use Illuminate\Http\Request;

class LibraryBookController extends Controller
{
    public function __construct(private LibraryBookService $service) {}

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('library.books.create',compact('tags','categories'));
    }

    public function store(StoreLibraryBookRequest $request)
    {
        $validated = $request->validated();

        $this->service->create(auth()->user(), $validated);

        return redirect(route('library.dashboard'))
            ->with('success', 'Book created with stock');
    }

    public function edit(Book $book)
{
    if ($book->library_id !== auth()->user()->library->id) {
        abort(403);
    }

    $tags = Tag::all();
    $categories = Category::all();
    return view('library.books.edit', compact('book', 'tags', 'categories'));
}

    public function update(UpdateBookRequest $request, Book $book)
    {
    $this->service->update(auth()->user(), $book, $request->validated());

    return redirect()->route('library.dashboard')
        ->with('success', 'Book updated successfully');
    }
    
    public function destroy(Book $book)
    {
    $this->service->delete(auth()->user(), $book);

    return back()->with('success', 'Book deleted successfully');
    }

    }
