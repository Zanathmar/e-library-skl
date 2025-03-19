@extends('layout.app')

@section('title')
    Borrow | {{$book->title}}
@endsection

@section('content')
<section class="p-6 md:p-8 max-w-7xl mx-auto">
    <div class="flex flex-col gap-6">
        <!-- Header and Back Button -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-text">Borrow Book</h1>
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-100 text-text rounded-full font-medium hover:bg-gray-200 transition-all duration-200 shadow-[0_3px_0_0_#d1d5db] hover:shadow-[0_1px_0_0_#d1d5db] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to Books
            </a>
        </div>

        <!-- Book Details Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-7 gap-6 p-6">
                <!-- Book Image -->
                <div class="md:col-span-3 flex justify-center md:justify-start">
                    <div class="relative">
                        <img src="{{ asset('storage/book-images/' . $book->image) }}" alt="{{ $book->title }}" class="w-full max-w-sm rounded-lg shadow-lg object-cover transform transition-transform hover:scale-105 hover:rotate-1" />
                        <div class="absolute -bottom-3 -right-3 bg-primary text-text px-3 py-1 rounded-full font-bold border-2 border-black shadow-md">
                            {{ $book->status }}
                        </div>
                    </div>
                </div>

                <!-- Book Info -->
                <div class="flex flex-col gap-4 md:col-span-4">
                    <div class="flex flex-col gap-6">
                        <div>
                            <h2 class="text-3xl font-bold text-text mb-2">{{ $book->title }}</h2>
                            <p class="text-gray-500 text-lg">by {{ $book->author }} ({{ $book->published_year }})</p>
                        </div>

                        <div class="bg-secondary bg-opacity-20 p-4 rounded-xl">
                            <h3 class="font-semibold text-lg text-text mb-2">Description</h3>
                            <p class="text-gray-700">{{ $book->description }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <h3 class="font-semibold text-text">Total Pages</h3>
                                <p class="text-gray-700 text-lg">{{ $book->page_count }}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <h3 class="font-semibold text-text">Borrowed Times</h3>
                                <p class="text-gray-700 text-lg">{{ $book->borrow_count }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Borrow Section -->
                    <div class="mt-auto">
                        <div class="bg-primary bg-opacity-20 p-4 rounded-xl mb-4">
                            <h3 class="font-semibold text-text">Approximate Return Date</h3>
                            <p class="text-gray-700 text-lg font-medium">{{ now()->addDays(7)->format('l, j F Y') }}</p>
                        </div>
                        
                        <div class="text-right">
                            <form action={{route('borrow.request', $book->id)}} method="POST">
                                @csrf
                                <button type="submit" class="px-6 py-3 bg-primary border-2 border-black text-text rounded-full font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_4px_0_0_#000000] hover:shadow-[0_2px_0_0_#86c0ae] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-2 ml-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Proceed to Borrow
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Borrowing Policy -->
        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-md">
            <h3 class="font-semibold text-text mb-2 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                </svg>
                Borrowing Policy
            </h3>
            <ul class="list-disc list-inside text-gray-700 space-y-1 pl-2">
                <li>Books can be borrowed for a maximum of 7 days.</li>
                <li>Late returns will incur a fee of $0.50 per day.</li>
                <li>Books must be returned in the same condition.</li>
                <li>You may renew your borrow period once if the book is not reserved by another user.</li>
            </ul>
        </div>
    </div>
</section>
@endsection