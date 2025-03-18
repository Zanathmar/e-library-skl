<!-- resources/views/dashboard/admin/dashboard.blade.php -->
@extends('layout.app')

@section('title')
    Admin Dashboard
@endsection

@section('content')
<section class="p-6 flex flex-col gap-6 max-w-screen mx-auto bg-background min-h-screen">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-text">Admin Dashboard</h1>
        <a href="{{ route('book.index') }}" class="px-4 py-2 bg-primary border-2 border-black text-text rounded-full font-medium hover:bg-opacity-90 transition-colors shadow-[0_4px_0_0_#000000] hover:shadow-[0_2px_0_0_#86c0ae] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
            </svg>
            Manage Books
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow">
            <h3 class="text-gray-600 text-sm font-medium">Total Borrow Requests</h3>
            <p class="text-3xl font-bold text-text">{{ $totalRequests }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow">
            <h3 class="text-gray-600 text-sm font-medium">Pending Requests</h3>
            <p class="text-3xl font-bold text-text">{{ $pendingRequests }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow">
            <h3 class="text-gray-600 text-sm font-medium">Total Books</h3>
            <p class="text-3xl font-bold text-text">{{ $totalBooks }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow">
            <h3 class="text-gray-600 text-sm font-medium">Total Users</h3>
            <p class="text-3xl font-bold text-text">{{ $totalUsers }}</p>
        </div>
    </div>

    <!-- Borrow Requests Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="p-4 border-b border-gray-100">
            <h2 class="text-2xl font-bold text-text">Borrow Requests</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-primary text-text">
                        <th class="p-3 text-left">User</th>
                        <th class="p-3 text-left">Book</th>
                        <th class="p-3 text-left">Requested At</th>
                        <th class="p-3 text-left">Return Date</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($borrowRequests->count() === 0)
                        <tr>
                            <td colspan="6" class="p-3 text-center text-gray-500">No borrow requests found</td>
                        </tr>
                    @endif
                    @foreach ($borrowRequests as $request)
                        <tr class="border-b border-gray-100 hover:bg-secondary hover:bg-opacity-20 transition-colors">
                            <td class="p-3 text-text">{{ $request->user->name }}</td>
                            <td class="p-3 font-medium text-text">{{ $request->book->title }}</td>
                            <td class="p-3 text-text">{{ $request->created_at ? \Carbon\Carbon::parse($request->created_at)->format('Y-m-d') : '' }}</td>
                            <td class="p-3 text-text">{{ $request->returned_at ? \Carbon\Carbon::parse($request->returned_at)->format('Y-m-d') : '' }}</td>
                            <td class="p-3">
                                @if($request->status == 'pending')
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Pending</span>
                                @elseif($request->status == 'borrowed')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Borrowed</span>
                                @elseif($request->status == 'rejected')
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">Rejected</span>
                                @endif
                            </td>
                            <td class="p-3">
                                @if($request->status == 'pending')
                                    <div class="flex gap-2 justify-center">
                                        <form action="{{ route('borrow.accept') }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id" value="{{ $request->id }}">
                                            <button type="submit" class="px-3 py-1.5 bg-green-500 border-2 border-black text-white rounded-full text-sm font-medium hover:bg-opacity-90 transition-colors shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none">Accept</button>
                                        </form>
                                        <form action="{{ route('borrow.reject') }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id" value="{{ $request->id }}">
                                            <button type="submit" class="px-3 py-1.5 bg-red-500 border-2 border-black text-white rounded-full text-sm font-medium hover:bg-opacity-90 transition-colors shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none">Reject</button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-gray-500 text-sm">Processed</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Analytics Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Borrow Status Chart -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-4 border-b border-gray-100">
                <h2 class="text-2xl font-bold text-text">Borrow Statistics</h2>
            </div>
            <div class="p-4">
                <div class="h-64">
                    <canvas id="borrowChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Book Categories Chart -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-4 border-b border-gray-100">
                <h2 class="text-2xl font-bold text-text">Book Categories</h2>
            </div>
            <div class="p-4">
                <div class="h-64">
                    <canvas id="categoriesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Books -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="p-4 border-b border-gray-100">
            <h2 class="text-2xl font-bold text-text">Recent Books</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-primary text-text">
                        <th class="p-3 text-left">Title</th>
                        <th class="p-3 text-left">Cover</th>
                        <th class="p-3 text-left">Author</th>
                        <th class="p-3 text-left">Year</th>
                        <th class="p-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($recentBooks->count() === 0)
                        <tr>
                            <td colspan="5" class="p-3 text-center text-gray-500">No books found</td>
                        </tr>
                    @endif
                    @foreach ($recentBooks as $book)
                        <tr class="border-b border-gray-100 hover:bg-secondary hover:bg-opacity-20 transition-colors">
                            <td class="p-3 font-medium text-text">{{ $book->title }}</td>
                            <td class="p-3">
                                <img src="{{ asset('storage/book-images/' . $book->image) }}" alt="{{ $book->title }}"
                                    class="w-16 h-24 object-cover rounded-md shadow-[2px_2px_0_0_rgba(0,0,0,0.1)]" />
                            </td>
                            <td class="p-3 text-text">{{ $book->author }}</td>
                            <td class="p-3 text-text">{{ $book->published_year }}</td>
                            <td class="p-3 text-center">
                                @if($book->status == 'available')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Available</span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">Unavailable</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Borrow Status Chart
        const borrowCtx = document.getElementById('borrowChart').getContext('2d');
        const borrowChart = new Chart(borrowCtx, {
            type: 'pie',
            data: {
                labels: ['Pending', 'Borrowed', 'Rejected'],
                datasets: [{
                    data: [{{ $pendingRequests }}, {{ $borrowedCount }}, {{ $rejectedCount }}],
                    backgroundColor: [
                        '#FBBF24',
                        '#10B981',
                        '#EF4444'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Book Categories Chart
        const categoriesCtx = document.getElementById('categoriesChart').getContext('2d');
        const categoriesChart = new Chart(categoriesCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($categoryLabels) !!},
                datasets: [{
                    data: {!! json_encode($categoryData) !!},
                    backgroundColor: [
                        '#3B82F6',
                        '#8B5CF6',
                        '#F59E0B',
                        '#06B6D4',
                        '#EC4899',
                        '#6366F1'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
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
            position: "right",
            stopOnFocus: true,
            style: {
                background: "#EF4444", // Red for warnings/errors
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