@extends('layouts.app')

@section('title', $book->title)

@section('content')

<div class="max-w-5xl mx-auto bg-white border border-amber-100 rounded-2xl shadow-sm p-6">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

        {{-- IMAGE --}}
        <div>
            <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}"
                 class="w-full h-96 object-cover rounded-xl">
        </div>

        {{-- INFO --}}
        <div class="flex flex-col">

            {{-- TITLE --}}
            <h1 class="text-3xl font-bold text-stone-800 mb-2">
                {{ $book->title }}
            </h1>

            {{-- AUTHOR --}}
            <p class="text-sm text-stone-600 mb-1">
                by
                <a href="{{ route('books.author', $book->author) }}"
                   class="hover:text-amber-700">
                    {{ $book->author }}
                </a>
            </p>

            {{-- CATEGORY --}}
            <p class="text-xs text-stone-500 mb-3">
                <a href="{{ route('books.category', $book->category->id) }}"
                   class="hover:text-amber-700">
                    {{ $book->category->name ?? 'No Category' }}
                </a>
            </p>

            {{-- DESCRIPTION --}}
            <p class="text-sm text-stone-600 mb-6 leading-relaxed">
                {{ $book->description }}
            </p>

            {{-- TAGS --}}
            <div class="flex flex-wrap gap-2 mb-6">
                @foreach($book->tags as $tag)
                    <a href="{{ route('books.tag', $tag->id) }}"
                       class="text-xs px-2 py-1 bg-amber-50 text-amber-700 rounded-full hover:bg-amber-100">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>

            {{-- STOCK --}}
            <div class="mb-4 text-sm font-medium">
                @if($book->totalStock > 5)
                    <span class="text-green-600">Available</span>
                @elseif($book->totalStock > 0)
                    <span class="text-yellow-600">Limited stock</span>
                @else
                    <span class="text-red-600">Out of stock</span>
                @endif
            </div>

            {{-- PRICE --}}
            <div class="mb-6 space-y-1 text-sm">
                <p class="font-semibold text-stone-800">
                    Buy: <span class="text-amber-700">{{ $book->purchase_price }} DH</span>
                </p>
                <p class="font-semibold text-stone-800">
                    Rent: <span class="text-amber-700">{{ $book->rental_price }} DH/day</span>
                </p>
            </div>

            {{-- LIBRARIES --}}
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-stone-700 mb-2">
                    Available at:
                </h3>

                <ul class="space-y-1 text-sm text-stone-600">
                    @foreach($book->stocks as $stock)
                        @if($stock->quantity > 0)
                            <li>
                                <a href="{{ route('library.show', $stock->library->id) }}"
                                   class="hover:text-amber-700">
                                    {{ $stock->library->name }}
                                </a>
                                ({{ $stock->quantity }} copies)
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            {{-- ACTIONS --}}
            @guest
                <p class="text-sm text-stone-400">
                    Login to interact
                </p>
            @else

                @if(auth()->user()->library)
                    <p class="text-sm text-stone-400">
                        Library account
                    </p>
                @else

                    @if($book->totalStock > 0)

                        {{-- BUY --}}
                        <form method="POST"
                              action="{{ route('books.summary', $book->id) }}"
                              class="mb-4 border border-amber-100 p-4 rounded-xl bg-amber-50/40">
                            @csrf

                            <h3 class="text-sm font-semibold text-stone-700 mb-2">
                                Buy
                            </h3>

                            <div class="flex items-center gap-3 mb-3">
                                <label class="text-xs text-stone-500">Quantity</label>
                                <input type="number" name="quantity" value="1" min="1"
                                       class="border border-stone-300 px-2 py-1 rounded w-20">
                            </div>

                            <button class="w-full bg-amber-700 text-white py-2 rounded-lg hover:bg-amber-800 text-sm">
                                Buy Now
                            </button>
                        </form>

                        {{-- RENT --}}
                        <form method="POST"
                              action="{{ route('books.summary', $book->id) }}"
                              class="border border-amber-100 p-4 rounded-xl bg-amber-50/40">
                            @csrf

                            <h3 class="text-sm font-semibold text-stone-700 mb-2">
                                Rent
                            </h3>

                            <div class="flex gap-3 mb-3">
                                <div>
                                    <label class="text-xs text-stone-500">Quantity</label>
                                    <input type="number" name="quantity" value="1" min="1"
                                           class="border border-stone-300 px-2 py-1 rounded w-20">
                                </div>

                                <div>
                                    <label class="text-xs text-stone-500">Days</label>
                                    <input type="number" name="days" value="1" min="1"
                                           class="border border-stone-300 px-2 py-1 rounded w-20">
                                </div>
                            </div>

                            <button class="w-full bg-stone-800 text-white py-2 rounded-lg hover:bg-black text-sm">
                                Rent Now
                            </button>
                        </form>

                    @else
                        <button disabled class="bg-stone-300 w-full py-2 rounded-lg text-sm">
                            Not Available
                        </button>
                    @endif

                @endif

            @endguest

        </div>

    </div>

</div>

@endsection