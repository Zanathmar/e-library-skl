@extends('layout.app')

@section('title')
    Home | {{ auth()->user()->name }}
@endsection

@section('content')
<section class="p-4 md:p-8 flex flex-col gap-6 max-w-7xl mx-auto bg-background min-h-screen">
    <!-- Header with Welcome Message and Action Buttons -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div class="animate-fade-in">
            <h1 class="text-3xl md:text-4xl font-bold text-text tracking-tight">Welcome, {{ auth()->user()->name }}</h1>
            <p class="text-lg text-gray-600 mt-1">Your personal library dashboard</p>
        </div>

        <div class="flex items-center gap-3 animate-slide-in-right">
            <a href="#" class="px-4 py-2 bg-secondary border-2 border-black text-text rounded-full font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-2" aria-label="Go to dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="#" class="px-4 py-2 bg-primary border-2 border-black text-text rounded-full font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-2" aria-label="Go to profile">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 005 10a6 6 0 0012 0c0-.35-.022-.687-.063-1.022A5 5 0 0010 7z" clip-rule="evenodd" />
                </svg>
                <span>Profile</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 mb-6">
        <div class="bg-white rounded-2xl p-5 md:p-6 shadow-lg border border-gray-100 transform hover:scale-105 transition-all duration-300 animate-fade-in">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-primary bg-opacity-20 rounded-xl mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-text">Total Books</h3>
                    <p class="text-3xl font-bold text-text">{{ $books->total() }}</p>
                </div>
            </div>
            <div class="h-1 w-full bg-gray-200 rounded-full mt-2">
                <div class="h-1 bg-primary rounded-full" style="width: 100%"></div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 md:p-6 shadow-lg border border-gray-100 transform hover:scale-105 transition-all duration-300 animate-fade-in" style="animation-delay: 0.1s">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-secondary bg-opacity-20 rounded-xl mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-text">Available Books</h3>
                    <p class="text-3xl font-bold text-text">{{ $available = $books->where('status', 'available')->count() }}</p>
                </div>
            </div>
            @php $availablePercentage = $books->total() > 0 ? round(($available / $books->total()) * 100) : 0; @endphp
            <div class="h-1 w-full bg-gray-200 rounded-full mt-2">
                <div class="h-1 bg-yellow-500 rounded-full" style="width: {{ $availablePercentage }}%"></div>
            </div>
            <p class="text-xs text-gray-500 mt-2">{{ $availablePercentage }}% of total collection</p>
        </div>

        <div class="bg-white rounded-2xl p-5 md:p-6 shadow-lg border border-gray-100 transform hover:scale-105 transition-all duration-300 animate-fade-in" style="animation-delay: 0.2s">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-red-400 bg-opacity-20 rounded-xl mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
                        <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-text">Borrowed Books</h3>
                    <p class="text-3xl font-bold text-text">{{ $borrowed = $books->where('status', '!=', 'available')->count() }}</p>
                </div>
            </div>
            @php $borrowedPercentage = $books->total() > 0 ? round(($borrowed / $books->total()) * 100) : 0; @endphp
            <div class="h-1 w-full bg-gray-200 rounded-full mt-2">
                <div class="h-1 bg-red-500 rounded-full" style="width: {{ $borrowedPercentage }}%"></div>
            </div>
            <p class="text-xs text-gray-500 mt-2">{{ $borrowedPercentage }}% of total collection</p>
        </div>
    </div>

    <!-- Book List Header and Search -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4 md:mb-6">
        <div class="flex items-center gap-3">
            <h2 class="text-2xl font-bold text-text tracking-tight flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Book Collection
            </h2>
            <span class="px-3 py-1 bg-primary bg-opacity-20 text-primary text-sm font-medium rounded-full">{{ $books->total() }} items</span>
        </div>
        
        <!-- Search Bar with clear button -->
        <div class="w-full md:w-1/3 relative">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
                <input type="text" id="search" name="search" placeholder="Search by title or author..." class="pl-12 pr-10 py-3 bg-white w-full border-2 border-gray-200 text-text rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-30 transition-all shadow-sm">
                <button id="clearSearch" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div id="searchResults" class="text-sm text-gray-500 mt-1 hidden">
                <span id="resultCount">0</span> results found
            </div>
        </div>
    </div>

    <!-- Filter Options -->
    <div class="flex flex-wrap gap-2 mb-4">
        <button id="filterAll" class="px-3 py-1 bg-primary text-text text-sm rounded-full font-medium border-2 border-black shadow-[0_2px_0_0_#000000] active:translate-y-0.5 active:shadow-none transition-all">All Books</button>
        <button id="filterAvailable" class="px-3 py-1 bg-white text-text text-sm rounded-full font-medium border-2 border-gray-300 hover:border-black hover:shadow-[0_2px_0_0_#000000] transition-all">Available</button>
        <button id="filterBorrowed" class="px-3 py-1 bg-white text-text text-sm rounded-full font-medium border-2 border-gray-300 hover:border-black hover:shadow-[0_2px_0_0_#000000] transition-all">Borrowed</button>
    </div>

    <!-- Books Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 animate-fade-up">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-primary bg-opacity-95 text-text">
                        <th class="px-4 py-4 text-left font-semibold">#</th>
                        <th class="px-4 py-4 text-left font-semibold">
                            <div class="flex items-center gap-1 cursor-pointer" id="sortTitle">
                                Title
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </th>
                        <th class="px-4 py-4 text-left font-semibold">Cover</th>
                        <th class="px-4 py-4 text-left font-semibold">
                            <div class="flex items-center gap-1 cursor-pointer" id="sortAuthor">
                                Author
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </th>
                        <th class="px-4 py-4 text-left font-semibold">
                            <div class="flex items-center gap-1 cursor-pointer" id="sortYear">
                                Year
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </th>
                        <th class="px-4 py-4 text-center font-semibold">Status</th>
                        <th class="px-4 py-4 text-center font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody id="booksTableBody">
                    @if ($books->count() === 0)
                        <tr>
                            <td colspan="7" class="p-6 text-center text-gray-500 font-medium">
                                <div class="flex flex-col items-center justify-center py-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <p class="text-lg font-medium">No books found</p>
                                    <p class="text-gray-500">Try adjusting your search or filter criteria</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                    
                    @foreach ($books as $book)
                        <tr class="border-b border-gray-100 hover:bg-secondary hover:bg-opacity-10 transition-colors book-row" data-status="{{ $book->status }}">
                            <td class="px-4 py-4 text-text">{{ $books->perPage() * ($books->currentPage() - 1) + $loop->index + 1 }}</td>
                            <td class="px-4 py-4 font-medium text-text">
                                <div class="line-clamp-2">{{ $book->title }}</div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="relative group">
                                    <img src="{{ asset('storage/book-images/' . $book->image) }}" alt="{{ $book->title }}" class="w-16 h-24 object-cover rounded-lg shadow-lg transform transition-transform group-hover:scale-105 group-hover:rotate-2">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 rounded-lg transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                        <a href="{{ route('book.show', $book->slug) }}" class="text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-text">{{ $book->author }}</td>
                            <td class="px-4 py-4 text-text">{{ $book->published_year }}</td>
                            <td class="px-4 py-4 text-center">
                                @if ($book->status == 'available')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Available</span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">Borrowed</span>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('book.show', $book->slug) }}" class="px-3 py-1.5 bg-secondary border-2 border-black text-text rounded-full text-sm font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View
                                    </a>
                                    
                                    @if ($book->status == 'available')
                                        <a href="{{ route('dashboard.borrow', $book->slug) }}" class="px-3 py-1.5 bg-primary border-2 border-black text-text rounded-full text-sm font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                            Borrow
                                        </a>
                                    @else
                                        <button type="button" disabled class="px-3 py-1.5 bg-gray-300 border-2 border-black text-gray-500 rounded-full text-sm font-medium cursor-not-allowed opacity-70 flex items-center gap-1" title="Not available">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                            Borrowed
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- No Results Message -->
    <div id="noResultsMessage" class="hidden">
        <div class="bg-white rounded-2xl p-8 text-center shadow-lg border border-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <h3 class="text-xl font-bold text-text mb-2">No Books Found</h3>
            <p class="text-gray-600 mb-4">We couldn't find any books matching your search.</p>
            <button id="clearFilters" class="px-4 py-2 bg-primary border-2 border-black text-text rounded-full font-medium shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all duration-200">
                Clear All Filters
            </button>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-6 animate-fade-up" style="animation-delay: 0.3s">
        <div class="bg-white rounded-xl p-3 shadow-lg">
            <div class="flex items-center gap-3">
                @if ($books->onFirstPage())
                    <span class="px-5 py-2 bg-gray-100 text-gray-400 rounded-full font-medium cursor-not-allowed">Previous</span>
                @else
                    <a href="{{ $books->previousPageUrl() }}" class="px-5 py-2 bg-primary border-2 border-black text-text rounded-full font-medium shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all duration-200 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Previous
                    </a>
                @endif

                <div class="flex items-center gap-2">
                    @php
                        $currentPage = $books->currentPage();
                        $lastPage = $books->lastPage();
                        $maxVisiblePages = 5;

                        if ($lastPage <= $maxVisiblePages) {
                            $startPage = 1;
                            $endPage = $lastPage;
                        } else {
                            $startPage = max(1, $currentPage - floor($maxVisiblePages / 2));
                            $endPage = min($lastPage, $startPage + $maxVisiblePages - 1);
                            
                            if ($endPage - $startPage + 1 < $maxVisiblePages) {
                                $startPage = max(1, $endPage - $maxVisiblePages + 1);
                            }
                        }
                    @endphp

                    @if ($startPage > 1)
                        <a href="{{ $books->url(1) }}" class="w-10 h-10 flex items-center justify-center bg-gray-100 text-text rounded-full font-medium hover:bg-gray-200 shadow-[0_2px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all duration-200">1</a>
                        @if ($startPage > 2)
                            <span class="px-2 text-gray-400">...</span>
                        @endif
                    @endif

                    @for ($i = $startPage; $i <= $endPage; $i++)
                        @if ($i == $currentPage)
                            <span class="w-10 h-10 flex items-center justify-center bg-primary border-2 border-black text-text rounded-full font-medium shadow-[0_2px_0_0_#000000] transition-all duration-200">{{ $i }}</span>
                        @else
                            <a href="{{ $books->url($i) }}" class="w-10 h-10 flex items-center justify-center bg-gray-100 text-text rounded-full font-medium hover:bg-gray-200 shadow-[0_2px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all duration-200">{{ $i }}</a>
                        @endif
                    @endfor

                    @if ($endPage < $lastPage)
                        @if ($endPage < $lastPage - 1)
                            <span class="px-2 text-gray-400">...</span>
                        @endif
                        <a href="{{ $books->url($lastPage) }}" class="w-10 h-10 flex items-center justify-center bg-gray-100 text-text rounded-full font-medium hover:bg-gray-200 shadow-[0_2px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all duration-200">{{ $lastPage }}</a>
                    @endif
                </div>

                @if ($books->hasMorePages())
                    <a href="{{ $books->nextPageUrl() }}" class="px-5 py-2 bg-primary border-2 border-black text-text rounded-full font-medium shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all duration-200 flex items-center gap-1">
                        Next
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @else
                    <span class="px-5 py-2 bg-gray-100 text-gray-400 rounded-full font-medium cursor-not-allowed">Next</span>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- JavaScript for Search and Filtering -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const searchInput = document.getElementById('search');
        const clearSearchBtn = document.getElementById('clearSearch');
        const searchResults = document.getElementById('searchResults');
        const resultCount = document.getElementById('resultCount');
        const booksTableBody = document.getElementById('booksTableBody');
        const noResultsMessage = document.getElementById('noResultsMessage');
        const clearFilters = document.getElementById('clearFilters');
        const bookRows = document.querySelectorAll('.book-row');
        
        // Filter buttons
        const filterAll = document.getElementById('filterAll');
        const filterAvailable = document.getElementById('filterAvailable');
        const filterBorrowed = document.getElementById('filterBorrowed');
        
        // Sort columns
        const sortTitle = document.getElementById('sortTitle');
        const sortAuthor = document.getElementById('sortAuthor');
        const sortYear = document.getElementById('sortYear');
        
        let currentFilter = 'all';
        let currentSort = { column: 'title', direction: 'asc' };
        
        // Search functionality
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            if (searchTerm) {
                clearSearchBtn.classList.remove('hidden');
                searchResults.classList.remove('hidden');
                
                let matchCount = 0;
                
                bookRows.forEach(row => {
                    const title = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const author = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                    const status = row.dataset.status;
                    
                    const matchesSearch = title.includes(searchTerm) || author.includes(searchTerm);
                    const matchesFilter = currentFilter === 'all' || 
                                         (currentFilter === 'available' && status === 'available') || 
                                         (currentFilter === 'borrowed' && status !== 'available');
                    
                    if (matchesSearch && matchesFilter) {
                        row.classList.remove('hidden');
                        matchCount++;
                    } else {
                        row.classList.add('hidden');
                    }
                });
                
                resultCount.textContent = matchCount;
                
                if (matchCount === 0) {
                    noResultsMessage.classList.remove('hidden');
                    document.querySelector('table').classList.add('hidden');
                } else {
                    noResultsMessage.classList.add('hidden');
                    document.querySelector('table').classList.remove('hidden');
                }
            } else {
                clearSearchBtn.classList.add('hidden');
                searchResults.classList.add('hidden');
                
                // Reset to current filter
                applyFilter(currentFilter);
            }
        });
        
        // Clear search
        clearSearchBtn.addEventListener('click', function() {
            searchInput.value = '';
            clearSearchBtn.classList.add('hidden');
            searchResults.classList.add('hidden');
            
            // Reset to current filter
            applyFilter(currentFilter);
        });
        
        // Filter functionality
        function applyFilter(filter) {
            currentFilter = filter;
            
            // Update active filter button
            [filterAll, filterAvailable, filterBorrowed].forEach(btn => {
                btn.classList.remove('bg-primary', 'border-black', 'shadow-[0_2px_0_0_#000000]');
                btn.classList.add('bg-white', 'border-gray-300');
            });
            
            if (filter === 'all') {
                filterAll.classList.remove('bg-white', 'border-gray-300');
                filterAll.classList.add('bg-primary', 'border-black', 'shadow-[0_2px_0_0_#000000]');
            } else if (filter === 'available') {
                filterAvailable.classList.remove('bg-white', 'border-gray-300');
                filterAvailable.classList.add('bg-primary', 'border-black', 'shadow-[0_2px_0_0_#000000]');
            } else if (filter === 'borrowed') {
                filterBorrowed.classList.remove('bg-white', 'border-gray-300');
                filterBorrowed.classList.add('bg-primary', 'border-black', 'shadow-[0_2px_0_0_#000000]');
            }
            
            // Apply filter to table
            let visibleCount = 0;
            
            bookRows.forEach(row => {
                const status = row.dataset.status;
                
                if (filter === 'all' || 
                    (filter === 'available' && status === 'available') || 
                    (filter === 'borrowed' && status !== 'available')) {
                    row.classList.remove('hidden');
                    visibleCount++;
                } else {
                    row.classList.add('hidden');
                }
            });
            
            // Show/hide no results message
            if (visibleCount === 0) {
                noResultsMessage.classList.remove('hidden');
                document.querySelector('table').classList.add('hidden');
            } else {
                noResultsMessage.classList.add('hidden');
                document.querySelector('table').classList.remove('hidden');
            }
        }
        
        // Filter button events
        filterAll.addEventListener('click', () => applyFilter('all'));
        filterAvailable.addEventListener('click', () => applyFilter('available'));
        filterBorrowed.addEventListener('click', () => applyFilter('borrowed'));
        
        // Clear filters
        clearFilters.addEventListener('click', function() {
            searchInput.value = '';
            clearSearchBtn.classList.add('hidden');
            searchResults.classList.add('hidden');
            applyFilter('all');
        });
        
        // Sorting functionality
        function sortBooks(column) {
            const rows = Array.from(bookRows);
            
            // Toggle sort direction if same column
            if (currentSort.column === column) {
                currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
            } else {
                currentSort.column = column;
                currentSort.direction = 'asc';
            }
            
            // Sort rows
            rows.sort((a, b) => {
                let valA, valB;
                
                if (column === 'title') {
                    valA = a.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    valB = b.querySelector('td:nth-child(2)').textContent.toLowerCase();
                } else if (column === 'author') {
                    valA = a.querySelector('td:nth-child(4)').textContent.toLowerCase();
                    valB = b.querySelector('td:nth-child(4)').textContent.toLowerCase();
                } else if (column === 'year') {
                    valA = parseInt(a.querySelector('td:nth-child(5)').textContent);
                    valB = parseInt(b.querySelector('td:nth-child(5)').textContent);
                }
                
                if (currentSort.direction === 'asc') {
                    return valA > valB ? 1 : -1;
                } else {
                    return valA < valB ? 1 : -1;
                }
            });
            
            // Re-append sorted rows
            rows.forEach(row => {
                booksTableBody.appendChild(row);
            });
        }
        
        // Sort column events
        sortTitle.addEventListener('click', () => sortBooks('title'));
        sortAuthor.addEventListener('click', () => sortBooks('author'));
        sortYear.addEventListener('click', () => sortBooks('year'));
    });
</script>
@endsection