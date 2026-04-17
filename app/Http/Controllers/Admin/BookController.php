<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\StoreBookRequest;
use App\Http\Requests\Books\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Library;
use App\Models\Tag;
use App\Services\Books\BookService;

class BookController extends Controller
{
    protected $service;

    public function __construct(BookService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $books = Book::latest()->get();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $tags = Tag::all();
        $libraries = Library::all();
        $categories = Category::all();
        return view('admin.books.create', compact('tags', 'libraries','categories'));
    }

    public function store(StoreBookRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.books.index')
            ->with('success', 'Book created');
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $this->service->update($book, $request->validated());

        return redirect()->route('admin.books.index')
            ->with('success', 'Book updated');
    }

    public function destroy(Book $book)
    {
        $this->service->delete($book);

        return back()->with('success', 'Book deleted');
    }
}