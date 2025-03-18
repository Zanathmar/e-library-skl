@extends('layout.app')

@section('title')
    Books
@endsection

@section('content')
<section class="p-6 flex flex-col gap-6 max-w-screen mx-auto bg-background min-h-screen">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-text">Books</h1>
        <a href="{{ route('book.create') }}" class="px-4 py-2 bg-primary border-2 border-black text-text rounded-full font-medium hover:bg-opacity-90 transition-colors shadow-[0_4px_0_0_#000000] hover:shadow-[0_2px_0_0_#86c0ae] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New Book
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-primary text-text">
                        <th class="p-3 text-left">#</th>
                        <th class="p-3 text-left">Title</th>
                        <th class="p-3 text-left">Cover</th>
                        <th class="p-3 text-left">Author</th>
                        <th class="p-3 text-left">Year</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($books->count() === 0)
                    <tr class="">
                        <td colspan="6" class="p-3 text-center text-gray-500">No books found</td>
                    </tr>
                    @endif
                    @foreach ($books as $book)
                        <tr class="border-b border-gray-100 hover:bg-secondary hover:bg-opacity-20 transition-colors">
                            <td class="p-3 text-text">{{ $books->perPage() * ($books->currentPage() - 1) + $loop->index + 1 }}</td>
                            <td class="p-3 font-medium text-text">{{ $book->title }}</td>
                            <td class="p-3">
                                <img src="{{ asset("storage/book-images/" . $book->image) }}" alt="{{$book->title}}" class="w-16 h-24 object-cover rounded-md shadow-[2px_2px_0_0_rgba(0,0,0,0.1)]">
                            </td>
                            <td class="p-3 text-text">{{ $book->author }}</td>
                            <td class="p-3 text-text">{{ $book->published_year }}</td>
                            <td class="p-3">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('dashboard.borrow', $book->slug) }}" class="px-3 py-1.5 bg-secondary border-2 border-black text-text rounded-full text-sm font-medium hover:bg-opacity-90 transition-colors shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none">Detail</a>
                                    <a href="{{ route('book.edit', $book->id) }}" class="px-3 py-1.5 bg-primary border-2 border-black text-text rounded-full text-sm font-medium hover:bg-opacity-90 transition-colors shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none">Edit</a>
                                    <button 
                                        onclick="confirmDelete({{ $book->id }}, '{{ $book->title }}')" 
                                        class="px-3 py-1.5 bg-red-500 border-2 border-black text-white rounded-full text-sm font-medium hover:bg-opacity-90 transition-colors shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none"
                                    >Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex justify-center mt-4">
        <div class="bg-white rounded-lg p-2 shadow-md">
            <div class="flex items-center gap-2">
                @if ($books->onFirstPage())
                    <span class="px-4 py-2 bg-gray-200 text-text opacity-50 rounded-full font-medium cursor-not-allowed">Previous</span>
                @else
                    <a href="{{ $books->previousPageUrl() }}" class="px-4 py-2 bg-primary text-text rounded-full font-medium shadow-[0_3px_0_0_#86c0ae] hover:shadow-[0_1px_0_0_#86c0ae] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all">Previous</a>
                @endif

                <div class="flex items-center gap-1">
                    @for ($i = 1; $i <= $books->lastPage(); $i++)
                        @if ($i == $books->currentPage())
                            <span class="w-8 h-8 flex items-center justify-center bg-primary text-text rounded-full font-medium shadow-[0_3px_0_0_#86c0ae]">{{ $i }}</span>
                        @else
                            <a href="{{ $books->url($i) }}" class="w-8 h-8 flex items-center justify-center bg-gray-100 text-text rounded-full font-medium hover:bg-gray-200 shadow-[0_2px_0_0_#d1d5db] hover:shadow-[0_1px_0_0_#d1d5db] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all">{{ $i }}</a>
                        @endif
                    @endfor
                </div>

                @if ($books->hasMorePages())
                    <a href="{{ $books->nextPageUrl() }}" class="px-4 py-2 bg-primary text-text rounded-full font-medium shadow-[0_3px_0_0_#86c0ae] hover:shadow-[0_1px_0_0_#86c0ae] hover:translate-y-0.5 active:translate-y-1 active:shadow-none transition-all">Next</a>
                @else
                    <span class="px-4 py-2 bg-gray-200 text-text opacity-50 rounded-full font-medium cursor-not-allowed">Next</span>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Confirmation Modal for Delete -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-xl p-6 max-w-md w-full shadow-xl">
        <h3 class="text-xl font-bold text-text mb-4">Confirm Deletion</h3>
        <p id="deleteMessage" class="text-gray-700 mb-6">Are you sure you want to delete this book? This action cannot be undone.</p>
        <div class="flex justify-end gap-3">
            <button 
                onclick="closeModal()" 
                class="px-4 py-2 bg-gray-200 text-text rounded-full font-medium"
            >
                Cancel
            </button>
            <form id="deleteForm" action="" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-red-500 text-white rounded-full font-medium"
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
    function confirmDelete(id, title) {
        document.getElementById('deleteMessage').textContent = `Are you sure you want to delete "${title}"? This action cannot be undone.`;
        document.getElementById('deleteForm').action = `/books/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }
    
    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
    
    // Close modal if user clicks outside of it
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target == modal) {
            closeModal();
        }
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeModal();
        }
    });
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
            background: "#A7D7C5", // Success - keep green color
            color: "#4A4A4A",
            borderRadius: "8px",
            boxShadow: "0 4px 0 #86c0ae, 0 6px 15px rgba(0,0,0,0.1)",
            padding: "12px 20px",
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
            color: "#FFFFFF",
            borderRadius: "8px",
            boxShadow: "0 4px 0 #b91c1c, 0 6px 15px rgba(0,0,0,0.1)",
            padding: "12px 20px",
            fontWeight: "500"
        },
        onClick: function(){}
    }).showToast();
</script>
@endif
@endsection