@extends('layouts.app')

@section('title', 'BookRent Home')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Welcome to BookRent</h1>
    <div>
        @guest
            <a href="/login" class="mr-2 text-blue-500 hover:underline">Login</a>
            <a href="/register" class="text-green-500 hover:underline">Register</a>
        @else
            <a href="/dashboard" class="text-blue-500 hover:underline">Dashboard</a>
            <form method="POST" action="/logout" style="display: inline;">
                @csrf
                <button type="submit" class="text-blue-500 hover:underline bg-none border-none cursor-pointer">Logout</button>
            </form>
        @endguest
    </div>
</div>

<!-- Search form -->
<form method="GET" action="{{ route('books.search') }}" class="mb-6 flex gap-2">
    <input type="text" name="q" placeholder="Search by title, author, category"
           value="{{ request('q') }}" 
           class="flex-1 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    <button type="submit" class="px-4 bg-blue-500 text-white rounded hover:bg-blue-600">Search</button>
</form>

<!-- Books list -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($books as $book)
        <div class="bg-white shadow-md rounded p-4">
            <h3 class="text-lg font-bold mb-1">{{ $book->title }}</h3>
            <p class="text-gray-600 mb-1">Author: {{ $book->author }}</p>
            <p class="text-gray-500 mb-2">Category: {{ $book->category }}</p>

            <div class="flex flex-wrap gap-1 mb-2">
                @foreach($book->tags as $tag)
                    <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs">{{ $tag->name }}</span>
                @endforeach
            </div>

            @guest
                <p class="text-sm text-gray-500">Login to rent or purchase</p>
            @else
                <a href="#" class="text-white bg-green-500 px-3 py-1 rounded hover:bg-green-600">Rent</a>
                <a href="#" class="text-white bg-blue-500 px-3 py-1 rounded hover:bg-blue-600">Purchase</a>
            @endguest
        </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $books->links() }}
</div>
@endsection