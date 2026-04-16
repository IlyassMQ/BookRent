<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\UpdateBookRequest;
use App\Http\Requests\Library\StoreLibraryBookRequest;
use App\Models\Book;
use App\Services\Library\LibraryBookService;
use Illuminate\Http\Request;

class LibraryBookController extends Controller
{
    public function __construct(private LibraryBookService $service) {}

    public function create()
    {
        return view('library.books.create');
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
    // ownership check
    if ($book->library_id !== auth()->user()->library->id) {
        abort(403);
    }

    return view('library.books.edit', compact('book'));
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
