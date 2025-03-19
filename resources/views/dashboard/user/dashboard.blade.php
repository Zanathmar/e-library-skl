@extends('layout.app')

@section('title')
    Home | {{ auth()->user()->name }}
@endsection

@section('content')
<section class="p-8 flex flex-col gap-6 max-w-7xl mx-auto bg-background min-h-screen">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h1 class="text-4xl font-bold text-text tracking-tight">Welcome, {{ auth()->user()->name }}</h1>
            <p class="text-lg text-gray-600 mt-1">Your personal dashboard</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="#" class="px-4 py-2 bg-secondary border-2 border-black text-text rounded-full font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                Dashboard
            </a>
            <a href="#" class="px-4 py-2 bg-primary border-2 border-black text-text rounded-full font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 005 10a6 6 0 0012 0c0-.35-.022-.687-.063-1.022A5 5 0 0010 7z" clip-rule="evenodd" />
                </svg>
                Profile
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-primary bg-opacity-20 rounded-xl mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-text">Total Books</h3>
                    <p class="text-3xl font-bold text-primary">{{ $books->total() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-secondary bg-opacity-20 rounded-xl mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-secondary" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-text">Available Books</h3>
                    <p class="text-3xl font-bold text-secondary">{{ $books->where('status', 'available')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-red-400 bg-opacity-20 rounded-xl mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
                        <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-text">Borrowed Books</h3>
                    <p class="text-3xl font-bold text-red-500">{{ $books->where('status', '!=', 'available')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <h2 class="text-2xl font-bold text-text tracking-tight">Book List</h2>
        
        <!-- Search Bar -->
        <div class="w-full md:w-1/3 relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
            <input type="text" id="search" name="search" placeholder="Search by title or author..." class="pl-12 pr-4 py-3 bg-white w-full border-2 border-gray-200 text-text rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-30 transition-all shadow-sm">
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-primary text-text">
                        <th class="px-4 py-4 text-left font-semibold">#</th>
                        <th class="px-4 py-4 text-left font-semibold">Title</th>
                        <th class="px-4 py-4 text-left font-semibold">Cover</th>
                        <th class="px-4 py-4 text-left font-semibold">Author</th>
                        <th class="px-4 py-4 text-left font-semibold">Year</th>
                        <th class="px-4 py-4 text-center font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($books->count() === 0)
                        <tr>
                            <td colspan="6" class="p-6 text-center text-gray-500 font-medium">No books found</td>
                        </tr>
                    @endif
                    
                    @foreach ($books as $book)
                        <tr class="border-b border-gray-100 hover:bg-secondary hover:bg-opacity-10 transition-colors">
                            <td class="px-4 py-4 text-text">{{ $books->perPage() * ($books->currentPage() - 1) + $loop->index + 1 }}</td>
                            <td class="px-4 py-4 font-medium text-text">{{ $book->title }}</td>
                            <td class="px-4 py-4">
                                <img src="{{ asset('storage/book-images/' . $book->image) }}" alt="{{ $book->title }}" class="w-16 h-24 object-cover rounded-lg shadow-lg transform transition-transform hover:scale-105 hover:rotate-1">
                            </td>
                            <td class="px-4 py-4 text-text">{{ $book->author }}</td>
                            <td class="px-4 py-4 text-text">{{ $book->published_year }}</td>
                            <td class="px-4 py-4">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('book.show', $book->slug) }}" class="px-3 py-1.5 bg-secondary border-2 border-black text-text rounded-full text-sm font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none">Detail</a>
                                    
                                    @if ($book->status == 'available')
                                        <a href="{{ route('dashboard.borrow', $book->slug) }}" class="px-3 py-1.5 bg-primary border-2 border-black text-text rounded-full text-sm font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none">Borrow</a>
                                    @else
                                        <button type="button" disabled class="px-3 py-1.5 bg-gray-300 border-2 border-black text-gray-500 rounded-full text-sm font-medium cursor-not-allowed opacity-70" title="Not available">Borrow</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex justify-center mt-6">
        <div class="bg-white rounded-xl p-3 shadow-lg">
            <div class="flex items-center gap-3">
                @if ($books->onFirstPage())
                    <span class="px-5 py-2 bg-gray-100 text-gray-400 rounded-full font-medium cursor-not-allowed">Previous</span>
                @else
                    <a href="{{ $books->previousPageUrl() }}" class="px-5 py-2 bg-primary border-2 border-black text-text rounded-full font-medium shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all duration-200">Previous</a>
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
                            <span class="text-gray-500">...</span>
                        @endif
                    @endif

                    @for ($i = $startPage; $i <= $endPage; $i++)
                        @if ($i == $currentPage)
                            <span class="w-10 h-10 flex items-center justify-center bg-primary border-2 border-black text-text rounded-full font-medium shadow-[0_3px_0_0_#000000]">{{ $i }}</span>
                        @else
                            <a href="{{ $books->url($i) }}" class="w-10 h-10 flex items-center justify-center bg-gray-100 text-text rounded-full font-medium hover:bg-gray-200 shadow-[0_2px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all duration-200">{{ $i }}</a>
                        @endif
                    @endfor

                    @if ($endPage < $lastPage)
                        @if ($endPage < $lastPage - 1)
                            <span class="text-gray-500">...</span>
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
@endsection

@section('js')
<script>
    // Handle search functionality with debounce
    const searchInput = document.getElementById('search');
    let debounceTimeout;
    
    searchInput.addEventListener('keyup', function(e) {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            const searchValue = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                if (row.children.length <= 1) return; // Skip "No books found" row
                
                const titleCell = row.querySelector('td:nth-child(2)');
                const authorCell = row.querySelector('td:nth-child(4)');
                if (titleCell.textContent.toLowerCase().includes(searchValue) || 
                    authorCell.textContent.toLowerCase().includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }, 300);
    });

    @if (session('success'))
        Toastify({
            text: "{{ session('success') }}",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "#A7D7C5", // Success - green color
                color: "#4A4A4A",
                borderRadius: "12px",
                boxShadow: "0 4px 0 #86c0ae, 0 6px 15px rgba(0,0,0,0.1)",
                padding: "14px 22px",
                fontWeight: "500"
            },
            onClick: function(){}
        }).showToast();
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            Toastify({
                text: "{{ $error }}",
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
        @endforeach
    @endif
</script>
@endsection