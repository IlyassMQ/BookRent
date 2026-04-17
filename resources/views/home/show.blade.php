{{-- resources/views/home/show.blade.php --}}

@extends('layouts.app')

@section('title', $book->title)

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- IMAGE --}}
        <div>
            <img src="{{ $book->image ? asset('storage/'.$book->image) : asset('images/book.jpg') }}" alt="{{ $book->title }}"
                 class="w-full h-80 object-cover rounded">
        </div>

        {{-- INFO --}}
        <div>

            <h1 class="text-2xl font-bold mb-2">{{ $book->title }}</h1>

            <p class="text-gray-600 mb-2">Author: {{ $book->author }}</p>
            <p class="text-gray-500 mb-3">Category: {{ $book->category->name ?? 'No Category' }}</p>

            <p class="mb-4">{{ $book->description }}</p>

            {{-- STOCK --}}
            @if($book->totalStock > 0)
                <span class="text-green-600 font-semibold">
                    Available ({{ $book->totalStock }})
                </span>
            @else
                <span class="text-red-500 font-semibold">
                    Out of stock
                </span>
            @endif

            {{-- LIBRARIES --}}
            <div class="mt-4">
                <h3 class="font-semibold">Available at:</h3>

                <ul class="list-disc ml-5">
                    @foreach($book->stocks as $stock)
                        @if($stock->quantity > 0)
                            <li>
                                {{ $stock->library->name }}
                                ( {{ $stock->book->rental_price }} DH )
                            </li>
                        @endif
                        
                    @endforeach
                </ul>
            </div>

            {{-- ACTIONS --}}
            <div class="mt-6">

                @guest
                    <p class="text-gray-400">Login to interact</p>
                @else

                    @if(auth()->user()->library)

                        <span class="text-gray-400">
                            Library account
                        </span>

                    @else

                        @if($book->totalStock > 0)

                            <button class="bg-green-500 text-white px-4 py-2 rounded mr-2">
                                Rent
                            </button>

                            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                                Buy
                            </button>

                        @else
                            <button disabled class="bg-gray-300 px-4 py-2 rounded">
                                Not Available
                            </button>
                        @endif

                    @endif

                @endguest

            </div>

        </div>

    </div>

</div>

@endsection