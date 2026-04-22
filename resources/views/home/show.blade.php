@extends('layouts.app')

@section('title', $book->title)

@section('content')

<div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- IMAGE --}}
        <div>
            <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                 alt="{{ $book->title }}"
                 class="w-full h-96 object-cover rounded-lg">
        </div>

        {{-- INFO --}}
        <div class="flex flex-col">

            {{-- TITLE --}}
            <h1 class="text-3xl font-bold mb-2">{{ $book->title }}</h1>

            <p class="text-gray-600 mb-1">
                <a href="{{ route('books.author', $book->author) }}">
                    {{ $book->author }}
                </a>
            </p>

            <p class="text-gray-500 mb-3">
                <a href="{{ route('books.category', $book->category->id) }}">
                    {{ $book->category->name ?? 'No Category' }}
                </a>
            </p>

            <p class="text-gray-700 mb-5">
                {{ $book->description }}
            </p>

            {{-- STOCK --}}
            <div class="mb-4">
                @if($book->totalStock > 5)
                    <span class="text-green-600 font-semibold">Available</span>
                @elseif($book->totalStock > 0)
                    <span class="text-yellow-500 font-semibold">Limited stock</span>
                @else
                    <span class="text-red-500 font-semibold">Out of stock</span>
                @endif
            </div>

            {{-- PRICE --}}
            <div class="mb-6 space-y-1">
                <p class="text-lg font-semibold text-blue-600">
                    Buy: {{ $book->purchase_price }} DH
                </p>
                <p class="text-lg font-semibold text-green-600">
                    Rent (per day): {{ $book->rental_price }} DH
                </p>
            </div>
            @foreach($book->tags as $tag)
                <a href="{{ route('books.tag', $tag->id) }}">
                    {{ $tag->name }}
                </a>
            @endforeach

            {{-- LIBRARIES --}}
            <div class="mb-6">
                <h3 class="font-semibold mb-2">Available at:</h3>
                <ul class="list-disc ml-5 text-sm text-gray-600">
                    @foreach($book->stocks as $stock)
                        @if($stock->quantity > 0)
                            <li>
                                <a href="{{ route('library.show', $stock->library->id) }}"
                                    class="text-indigo-600 hover:underline">
                                        {{ $stock->library->name }}
                                    </a> ({{ $stock->quantity }} copies)
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            {{-- ACTIONS --}}
            @guest
                <p class="text-gray-400">Login to interact</p>
            @else

                @if(auth()->user()->library)
                    <p class="text-gray-400">Library account</p>
                @else

                    @if($book->totalStock > 0)

                        {{-- BUY --}}
                        <form method="POST"
                              action="{{ route('books.summary', $book->id) }}"
                              class="mb-4 border p-4 rounded-lg bg-gray-50">
                            @csrf

                            <h3 class="font-semibold mb-2">Buy</h3>

                            <div class="flex items-center gap-3 mb-3">
                                <label class="text-sm">Quantity</label>
                                <input type="number" name="quantity" value="1" min="1"
                                       class="border p-2 w-24 rounded">
                            </div>

                            <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                                Buy Now
                            </button>
                        </form>

                        {{-- RENT --}}
                        <form method="POST"
                              action="{{ route('books.summary', $book->id) }}"
                              class="border p-4 rounded-lg bg-gray-50">
                            @csrf

                            <h3 class="font-semibold mb-2">Rent</h3>

                            <div class="flex gap-3 mb-3">
                                <div>
                                    <label class="text-sm block">Quantity</label>
                                    <input type="number" name="quantity" value="1" min="1"
                                           class="border p-2 w-24 rounded">
                                </div>

                                <div>
                                    <label class="text-sm block">Days</label>
                                    <input type="number" name="days" value="1" min="1"
                                           class="border p-2 w-24 rounded">
                                </div>
                            </div>

                            <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                                Rent Now
                            </button>
                        </form>

                    @else
                        <button disabled class="bg-gray-300 w-full py-2 rounded">
                            Not Available
                        </button>
                    @endif

                @endif

            @endguest

        </div>

    </div>

</div>

@endsection