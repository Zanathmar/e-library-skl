@extends('layout.app')

@section('title')
    Books
@endsection

@section('content')
<section class="p-8 flex flex-col gap-6 max-w-7xl mx-auto bg-background min-h-screen">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <h1 class="text-4xl font-bold text-text tracking-tight">Books</h1>
        <a href="{{ route('book.create') }}" class="px-5 py-2.5 bg-primary border-2 border-black text-text rounded-full font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_4px_0_0_#000000] hover:shadow-[0_2px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-2 whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New Book
        </a>
    </div>

    <!-- Enhanced search bar with live search functionality -->
    <div class="mb-6 relative">
        <label for="search" class="sr-only">Search</label>
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
            <input type="text" id="search" name="search" placeholder="Search by title or author..." class="pl-12 pr-14 py-3 bg-white w-full border-2 border-gray-200 text-text rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-30 transition-all shadow-sm">
            <!-- Loading spinner (hidden by default) -->
            <div id="searchSpinner" class="hidden absolute right-14 top-1/2 transform -translate-y-1/2">
                <svg class="animate-spin h-5 w-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <!-- Clear search button -->
            <button id="clearSearch" class="hidden absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <!-- No results message (hidden by default) -->
        <div id="noResultsMessage" class="hidden mt-3 p-3 bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg">
            No books found matching "<span id="searchTerm"></span>". Try a different search term.
        </div>
    </div>

    <!-- Responsive table with card view toggle -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Table/Card View Toggle -->
        <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center">
            <p class="text-gray-500 text-sm">Showing <span id="showingStart" class="font-medium">{{ $books->firstItem() ?? 0 }}</span> to <span id="showingEnd" class="font-medium">{{ $books->lastItem() ?? 0 }}</span> of <span id="totalBooks" class="font-medium">{{ $books->total() }}</span> books</p>
            <div class="flex items-center gap-2">
                <button id="tableViewBtn" class="p-2 rounded-lg bg-primary text-text" aria-label="Table View" onclick="toggleView('table')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h12v1a1 1 0 01-1 1H5a1 1 0 01-1-1zm12-3V7a1 1 0 00-1-1H5a1 1 0 00-1 1v3h12z" clip-rule="evenodd" />
                    </svg>
                </button>
                <button id="cardViewBtn" class="p-2 rounded-lg text-gray-500" aria-label="Card View" onclick="toggleView('card')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Table View (Default) -->
        <div id="tableView" class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-primary text-text">
                        <th class="px-4 py-4 text-left font-semibold">#</th>
                        <th class="px-4 py-4 text-left font-semibold cursor-pointer" data-sort="title" onclick="sortTable('title')">
                            Title
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </th>
                        <th class="px-4 py-4 text-left font-semibold">Cover</th>
                        <th class="px-4 py-4 text-left font-semibold cursor-pointer" data-sort="author" onclick="sortTable('author')">
                            Author
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </th>
                        <th class="px-4 py-4 text-left font-semibold cursor-pointer" data-sort="year" onclick="sortTable('year')">
                            Year
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </th>
                        <th class="px-4 py-4 text-center font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody id="bookTableBody">
                    @if ($books->count() === 0)
                    <tr id="emptyMessage">
                        <td colspan="6" class="p-6 text-center text-gray-500 font-medium">No books found</td>
                    </tr>
                    @endif
                    @foreach ($books as $book)
                        <tr class="book-row border-b border-gray-100 hover:bg-secondary hover:bg-opacity-10 transition-colors" data-title="{{ $book->title }}" data-author="{{ $book->author }}" data-year="{{ $book->published_year }}">
                            <td class="px-4 py-4 text-text">{{ $books->perPage() * ($books->currentPage() - 1) + $loop->index + 1 }}</td>
                            <td class="px-4 py-4 font-medium text-text">{{ $book->title }}</td>
                            <td class="px-4 py-4">
                                <img src="{{ asset("storage/book-images/" . $book->image) }}" alt="{{ $book->title }}" class="w-16 h-24 object-cover rounded-lg shadow-lg transform transition-transform hover:scale-105 hover:rotate-1" loading="lazy">
                            </td>
                            <td class="px-4 py-4 text-text">{{ $book->author }}</td>
                            <td class="px-4 py-4 text-text">{{ $book->published_year }}</td>
                            <td class="px-4 py-4">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('book.show', $book->slug) }}" class="px-3 py-1.5 bg-secondary border-2 border-black text-text rounded-full text-sm font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none">Detail</a>
                                    <a href="{{ route('book.edit', $book->slug) }}" class="px-3 py-1.5 bg-primary border-2 border-black text-text rounded-full text-sm font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none">Edit</a>
                                    <button 
                                        onclick="confirmDelete({{ $book->id }}, '{{ $book->title }}')" 
                                        class="px-3 py-1.5 bg-red-500 border-2 border-black text-white rounded-full text-sm font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none"
                                    >Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Card View (Hidden by default) -->
        <div id="cardView" class="hidden">
            <div id="bookCardContainer" class="p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @if ($books->count() === 0)
                <div class="col-span-full p-6 text-center text-gray-500 font-medium">No books found</div>
                @endif
                @foreach ($books as $book)
                    <div class="book-card bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow duration-300" data-title="{{ $book->title }}" data-author="{{ $book->author }}" data-year="{{ $book->published_year }}">
                        <div class="relative h-48">
                            <img src="{{ asset("storage/book-images/" . $book->image) }}" alt="{{ $book->title }}" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1 text-text truncate">{{ $book->title }}</h3>
                            <p class="text-gray-600 mb-2">{{ $book->author }}</p>
                            <p class="text-gray-500 text-sm mb-4">{{ $book->published_year }}</p>
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('book.show', $book->slug) }}" class="px-3 py-1.5 bg-secondary border-2 border-black text-text rounded-full text-sm font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none">Detail</a>
                                <a href="{{ route('book.edit', $book->slug) }}" class="px-3 py-1.5 bg-primary border-2 border-black text-text rounded-full text-sm font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none">Edit</a>
                                <button 
                                    onclick="confirmDelete({{ $book->id }}, '{{ $book->title }}')" 
                                    class="px-3 py-1.5 bg-red-500 border-2 border-black text-white rounded-full text-sm font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none"
                                >Delete</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Enhanced pagination with responsive design -->
    <div class="flex flex-col items-center mt-6 gap-3">
        <!-- Items per page selector -->
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <span>Show:</span>
            <select id="perPage" class="rounded-lg border-2 border-gray-200 px-2 py-1 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-30 transition-all shadow-sm" onchange="changePerPage(this.value)">
                <option value="10" {{ $books->perPage() == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ $books->perPage() == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ $books->perPage() == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ $books->perPage() == 100 ? 'selected' : '' }}>100</option>
            </select>
            <span>books per page</span>
        </div>
        
        <!-- Pagination controls -->
        <div class="bg-white rounded-xl p-3 shadow-lg w-full overflow-auto">
            <div class="flex items-center justify-center gap-3">
                @if ($books->onFirstPage())
                    <span class="px-5 py-2 bg-gray-100 text-gray-400 rounded-full font-medium cursor-not-allowed">Previous</span>
                @else
                    <a href="{{ $books->previousPageUrl() }}" class="px-5 py-2 bg-primary border-2 border-black text-text rounded-full font-medium shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all duration-200">Previous</a>
                @endif

                <div class="flex items-center gap-2">
                    @php
                        $currentPage = $books->currentPage();
                        $lastPage = $books->lastPage();
                        $showPages = 5; // Number of page links to show
                        $startPage = max(1, $currentPage - floor($showPages / 2));
                        $endPage = min($lastPage, $startPage + $showPages - 1);
                        
                        if ($endPage - $startPage + 1 < $showPages) {
                            $startPage = max(1, $endPage - $showPages + 1);
                        }
                    @endphp

                    <!-- First page link -->
                    @if ($startPage > 1)
                        <a href="{{ $books->url(1) }}" class="w-10 h-10 flex items-center justify-center bg-gray-100 text-text rounded-full font-medium hover:bg-gray-200 shadow-[0_2px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all duration-200">1</a>
                        @if ($startPage > 2)
                            <span class="px-1 text-gray-500">...</span>
                        @endif
                    @endif

                    <!-- Page links -->
                    @for ($i = $startPage; $i <= $endPage; $i++)
                        @if ($i == $currentPage)
                            <span class="w-10 h-10 flex items-center justify-center bg-primary border-2 border-black text-text rounded-full font-medium shadow-[0_3px_0_0_#000000]">{{ $i }}</span>
                        @else
                            <a href="{{ $books->url($i) }}" class="w-10 h-10 flex items-center justify-center bg-gray-100 text-text rounded-full font-medium hover:bg-gray-200 shadow-[0_2px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all duration-200">{{ $i }}</a>
                        @endif
                    @endfor

                    <!-- Last page link -->
                    @if ($endPage < $lastPage)
                        @if ($endPage < $lastPage - 1)
                            <span class="px-1 text-gray-500">...</span>
                        @endif
                        <a href="{{ $books->url($lastPage) }}" class="w-10 h-10 flex items-center justify-center bg-gray-100 text-text rounded-full font-medium hover:bg-gray-200 shadow-[0_2px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all duration-200">{{ $lastPage }}</a>
                    @endif
                </div>

                @if ($books->hasMorePages())
                    <a href="{{ $books->nextPageUrl() }}" class="px-5 py-2 bg-primary border-2 border-black text-text rounded-full font-medium shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all duration-200">Next</a>
                @else
                    <span class="px-5 py-2 bg-gray-100 text-gray-400 rounded-full font-medium cursor-not-allowed">Next</span>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Enhanced delete modal with animation and confirmation -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full shadow-2xl border-2 border-gray-100 transform transition-all scale-95 opacity-0" id="modalContent">
        <h3 class="text-2xl font-bold text-text mb-4">Confirm Deletion</h3>
        <p id="deleteMessage" class="text-gray-700 mb-4">Are you sure you want to delete this book? This action cannot be undone.</p>
        
        <!-- Type to confirm deletion -->
        <div class="mb-6">
            <label for="confirmText" class="block text-sm font-medium text-gray-700 mb-2">Type <span class="font-bold text-red-500">DELETE</span> to confirm</label>
            <input type="text" id="confirmText" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="DELETE" />
        </div>
        
        <div class="flex justify-end gap-3">
            <button 
                onclick="closeModal()" 
                class="px-5 py-2.5 bg-gray-100 text-text rounded-full font-medium hover:bg-gray-200 transition-all duration-200"
            >
                Cancel
            </button>
            <form id="deleteForm" action="" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button 
                    type="submit" 
                    id="deleteButton"
                    disabled
                    class="px-5 py-2.5 bg-gray-300 text-gray-500 rounded-full font-medium transition-all duration-200 cursor-not-allowed"
                >
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // Global variables
    let currentView = 'table';
    let sortDirection = 'asc';
    let currentSortColumn = null;

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Set up clear search button
        const searchInput = document.getElementById('search');
        const clearSearchBtn = document.getElementById('clearSearch');
        
        if (searchInput && clearSearchBtn) {
            // Show/hide clear button based on input content
            searchInput.addEventListener('input', function() {
                clearSearchBtn.classList.toggle('hidden', this.value === '');
                if (this.value === '') {
                    resetSearch();
                }
            });
            
            // Clear search when button is clicked
            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                resetSearch();
                clearSearchBtn.classList.add('hidden');
                searchInput.focus();
            });
        }
        
        // Set up delete confirmation
        const confirmTextInput = document.getElementById('confirmText');
        const deleteButton = document.getElementById('deleteButton');
        
        if (confirmTextInput && deleteButton) {
            confirmTextInput.addEventListener('input', function() {
                const isConfirmed = this.value === 'DELETE';
                deleteButton.disabled = !isConfirmed;
                
                if (isConfirmed) {
                    deleteButton.classList.remove('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                    deleteButton.classList.add('bg-red-500', 'text-white', 'hover:bg-red-600', 'shadow-[0_3px_0_0_#000000]', 'hover:shadow-[0_1px_0_0_#000000]', 'hover:translate-y-0.5');
                } else {
                    deleteButton.classList.add('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                    deleteButton.classList.remove('bg-red-500', 'text-white', 'hover:bg-red-600', 'shadow-[0_3px_0_0_#000000]', 'hover:shadow-[0_1px_0_0_#000000]', 'hover:translate-y-0.5');
                }
            });
        }
        
        // Remember view preference in localStorage
        const savedView = localStorage.getItem('bookView');
        if (savedView) {
            toggleView(savedView);
        }
    });

    // Toggle between table and card view
    function toggleView(view) {
        const tableView = document.getElementById('tableView');
        const cardView = document.getElementById('cardView');
        const tableViewBtn = document.getElementById('tableViewBtn');
        const cardViewBtn = document.getElementById('cardViewBtn');
        
        if (view === 'table') {
            tableView.classList.remove('hidden');
            cardView.classList.add('hidden');
            tableViewBtn.classList.add('bg-primary', 'text-text');
            tableViewBtn.classList.remove('text-gray-500');
            cardViewBtn.classList.remove('bg-primary', 'text-text');
            cardViewBtn.classList.add('text-gray-500');
        } else {
            tableView.classList.add('hidden');
            cardView.classList.remove('hidden');
            tableViewBtn.classList.remove('bg-primary', 'text-text');
            tableViewBtn.classList.add('text-gray-500');
            cardViewBtn.classList.add('bg-primary', 'text-text');
            cardViewBtn.classList.remove('text-gray-500');
        }
        
        currentView = view;
        localStorage.setItem('bookView', view);
    }

    // Enhanced search functionality with debounce
    let debounceTimeout;
    function searchBooks() {
        const searchInput = document.getElementById('search');
        const searchValue = searchInput.value.toLowerCase().trim();
        const searchSpinner = document.getElementById('searchSpinner');
        const noResultsMessage = document.getElementById('noResultsMessage');
        const searchTerm = document.getElementById('searchTerm');
        
        // Show spinner while searching
        if (searchValue) {
            searchSpinner.classList.remove('hidden');
        }
        
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            // Hide spinner after search is completed
            searchSpinner.classList.add('hidden');
            
            // Search in table view
            const tableRows = document.querySelectorAll('.book-row');
            let foundCount = 0;
            
            tableRows.forEach(row => {
                const title = row.getAttribute('data-title').toLowerCase();
                const author = row.getAttribute('data-author').toLowerCase();
                
                if (title.includes(searchValue) || author.includes(searchValue)) {
                    row.style.display = '';
                    foundCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Show no results message if needed
            if (searchValue && foundCount === 0) {
                noResultsMessage.classList.remove('hidden');
                searchTerm.textContent = searchValue;
                document.getElementById('emptyMessage').style.display = 'none'; // Hide empty message if showing no results message
            } else {
                noResultsMessage.classList.add('hidden');
                // Show empty message if no books at all
                if (tableRows.length === 0 && !document.querySelector('.book-row[style="display: none;"]')) {
                    document.getElementById('emptyMessage').style.display = '';
                }
            }
            
            // Update showing text
            updateShowingText(foundCount);
        }, 300);
    }

    // Reset search and display all books
    function resetSearch() {
        const tableRows = document.querySelectorAll('.book-row');
        const cardItems = document.querySelectorAll('.book-card');
        const noResultsMessage = document.getElementById('noResultsMessage');
        
        tableRows.forEach(row => {
            row.style.display = '';
        });
        
        cardItems.forEach(card => {
            card.style.display = '';
        });
        
        noResultsMessage.classList.add('hidden');
        
        // Update showing text with total count
        updateShowingText(tableRows.length);
    }

    // Update showing text when filtering
    function updateShowingText(count) {
        const showingStart = document.getElementById('showingStart');
        const showingEnd = document.getElementById('showingEnd');
        const totalBooks = document.getElementById('totalBooks');
        
        if (count === 0) {
            showingStart.textContent = '0';
            showingEnd.textContent = '0';
        } else {
            const perPage = parseInt(document.getElementById('perPage').value);
            const currentPage = {{ $books->currentPage() }};
            
            showingStart.textContent = ((currentPage - 1) * perPage) + 1;
            showingEnd.textContent = Math.min(currentPage * perPage, count);
        }
    }

    // Sort table by column
    function sortTable(column) {
        // Toggle sort direction if clicking the same column
        if (currentSortColumn === column) {
            sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            currentSortColumn = column;
            sortDirection = 'asc';
        }
        
        // Get all table rows (skip header)
        const tableBody = document.getElementById('bookTableBody');
        const rows = Array.from(tableBody.querySelectorAll('tr.book-row'));
        
        // Sort rows
        rows.sort((a, b) => {
            let valA = a.getAttribute('data-' + column).toLowerCase();
            let valB = b.getAttribute('data-' + column).toLowerCase();
            
            // Handle numeric sorting for year
            if (column === 'year') {
                valA = parseInt(valA);
                valB = parseInt(valB);
            }
            
            if (valA < valB) {
                return sortDirection === 'asc' ? -1 : 1;
            }
            if (valA > valB) {
                return sortDirection === 'asc' ? 1 : -1;
            }
            return 0;
        });
        
        // Re-append rows in sorted order
        rows.forEach(row => {
            tableBody.appendChild(row);
        });
        
        // Update sort icons (placeholder for future enhancement)
        updateSortIcons(column);
    }

    // Update sort direction indicators
    function updateSortIcons(column) {
        // This function can be enhanced to show ascending/descending icons
        console.log(`Table sorted by ${column} in ${sortDirection} order`);
    }

    // Change number of items per page
    function changePerPage(value) {
        window.location.href = updateQueryStringParameter(window.location.href, 'perPage', value);
    }

    // Helper function to update URL query parameters
    function updateQueryStringParameter(uri, key, value) {
        const re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        const separator = uri.indexOf('?') !== -1 ? "&" : "?";
        
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        } else {
            return uri + separator + key + "=" + value;
        }
    }

    // Show delete confirmation modal
    // Show delete confirmation modal
function confirmDelete(id, title) {
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('modalContent');
    const deleteForm = document.getElementById('deleteForm');
    const deleteMessage = document.getElementById('deleteMessage');
    const confirmText = document.getElementById('confirmText');
    
    // Set delete form action - FIXED LINE
    deleteForm.action = `/book/delete/${id}`;
    
    // Update message with book title
    deleteMessage.innerHTML = `Are you sure you want to delete <strong class="font-semibold">"${title}"</strong>? This action cannot be undone.`;
    
    // Reset confirmation input
    confirmText.value = '';
    
    // Show modal with animation
    modal.classList.remove('hidden');
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

// Search function - fixed the card variable reference bug
function searchBooks() {
    const searchInput = document.getElementById('search');
    const searchValue = searchInput.value.toLowerCase().trim();
    const searchSpinner = document.getElementById('searchSpinner');
    const noResultsMessage = document.getElementById('noResultsMessage');
    const searchTerm = document.getElementById('searchTerm');
    
    // Show spinner while searching
    if (searchValue) {
        searchSpinner.classList.remove('hidden');
    }
    
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        // Hide spinner after search is completed
        searchSpinner.classList.add('hidden');
        
        // Search in table view
        const tableRows = document.querySelectorAll('.book-row');
        let foundCount = 0;
        
        tableRows.forEach(row => {
            const title = row.getAttribute('data-title').toLowerCase();
            const author = row.getAttribute('data-author').toLowerCase();
            
            if (title.includes(searchValue) || author.includes(searchValue)) {
                row.style.display = '';
                foundCount++;
            } else {
                row.style.display = 'none'; // FIXED: Changed 'card' to 'row'
            }
        });
        
        // Search in card view too
        const cardItems = document.querySelectorAll('.book-card');
        cardItems.forEach(card => {
            const title = card.getAttribute('data-title').toLowerCase();
            const author = card.getAttribute('data-author').toLowerCase();
            
            if (title.includes(searchValue) || author.includes(searchValue)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
        
        // Show no results message if needed
        if (searchValue && foundCount === 0) {
            noResultsMessage.classList.remove('hidden');
            searchTerm.textContent = searchValue;
            document.getElementById('emptyMessage').style.display = 'none'; // Hide empty message if showing no results message
        } else {
            noResultsMessage.classList.add('hidden');
            // Show empty message if no books at all
            if (tableRows.length === 0 && !document.querySelector('.book-row[style="display: none;"]')) {
                document.getElementById('emptyMessage').style.display = '';
            }
        }
        
        // Update showing text
        updateShowingText(foundCount);
    }, 300);
}

    // Event listeners
    document.getElementById('search').addEventListener('input', searchBooks);
</script>

@if (session('success'))
<script>
    Toastify({
        text: "{{ session('success') }}",
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        style: {
            background: "#1FEA55", // Success - keep green color
            color: "#4A4A4A",
            borderRadius: "12px",
            boxShadow: "0 4px 0 #86c0ae, 0 6px 15px rgba(0,0,0,0.1)",
            padding: "14px 22px",
            fontWeight: "500"
        },
        onClick: function(){}
    }).showToast();
</script>
@endif

@if (session('warning') || session('error') || session('danger'))
<script>
    Toastify({
        text: "{{ session('warning') ?? session('error') ?? session('danger') }}",
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        style: {
            background: "#EF4444", // Red color
            color: "#FFFFFF",
            borderRadius: "12px",
            boxShadow: "0 4px 0 #b91c1c, 0 6px 15px rgba(0,0,0,0.1)",
            padding: "14px 22px",
            fontWeight: "500"
        },
    }).showToast();
</script>
@endif
@endsection