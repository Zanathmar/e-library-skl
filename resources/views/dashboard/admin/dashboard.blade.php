<!-- resources/views/dashboard/admin/dashboard.blade.php -->
@extends('layout.app')

@section('title')
    Admin Dashboard
@endsection

@section('content')
<section class="p-6 flex flex-col gap-6 max-w-screen mx-auto bg-background min-h-screen">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-text">Admin Dashboard</h1>
        <div class="flex gap-2">
            <button id="refreshDashboard" class="px-4 py-2 bg-secondary border-2 border-black text-text rounded-full font-medium hover:bg-opacity-90 transition-colors shadow-[0_4px_0_0_#000000] hover:shadow-[0_2px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Refresh
            </button>
            <a href="{{ route('book.index') }}" class="px-4 py-2 bg-primary border-2 border-black text-text rounded-full font-medium hover:bg-opacity-90 transition-colors shadow-[0_4px_0_0_#000000] hover:shadow-[0_2px_0_0_#86c0ae] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                </svg>
                Manage Books
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-600 text-sm font-medium">Total Borrow Requests</h3>
                    <p class="text-3xl font-bold text-text">{{ $totalRequests }}</p>
                </div>
                <div class="bg-primary bg-opacity-20 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
            </div>
            <div class="mt-2 text-sm text-gray-500">All time requests</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-600 text-sm font-medium">Pending Requests</h3>
                    <p class="text-3xl font-bold text-text">{{ $pendingRequests }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-2 text-sm text-gray-500">Needs attention</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-600 text-sm font-medium">Total Books</h3>
                    <p class="text-3xl font-bold text-text">{{ $totalBooks }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
            </div>
            <div class="mt-2 text-sm text-gray-500">In library</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-600 text-sm font-medium">Total Users</h3>
                    <p class="text-3xl font-bold text-text">{{ $totalUsers }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-2 text-sm text-gray-500">Registered members</div>
        </div>
    </div>

    <!-- Analytics Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Borrow Status Chart -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-text">Borrow Statistics</h2>
                <div class="flex gap-2">
                    <button id="borrowChartType" class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors">
                        Switch to Bar
                    </button>
                    <div class="relative">
                        <select id="borrowTimeRange" class="appearance-none px-3 py-1.5 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors pr-8">
                            <option value="all">All Time</option>
                            <option value="month">Last Month</option>
                            <option value="week">Last Week</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <div class="h-64">
                    <canvas id="borrowChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Book Categories Chart -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-text">Book Categories</h2>
                <div class="flex gap-2">
                    <button id="categoryChartType" class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors">
                        Switch to Bar
                    </button>
                    <div class="relative">
                        <select id="categorySort" class="appearance-none px-3 py-1.5 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors pr-8">
                            <option value="count">Count</option>
                            <option value="alphabetical">Alphabetical</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <div class="h-64">
                    <canvas id="categoriesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Borrow Requests Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="p-4 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-text">Borrow Requests</h2>
            <div class="relative">
                <select id="requestFilter" class="appearance-none px-3 py-1.5 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors pr-8">
                    <option value="all">All Requests</option>
                    <option value="pending">Pending</option>
                    <option value="borrowed">Borrowed</option>
                    <option value="returned">Returned</option>
                    <option value="rejected">Rejected</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                    </svg>
                </div>
            </div>
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
                        <tr class="border-b border-gray-100 hover:bg-secondary hover:bg-opacity-20 transition-colors request-row" data-status="{{ $request->status }}">
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
                                @elseif($request->status == 'returned')
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">Returned</span>
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
                                @elseif($request->status == 'borrowed')
                                    <form action="{{ route('borrow.return') }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id" value="{{ $request->id }}">
                                        <button type="submit" class="px-3 py-1.5 bg-blue-500 border-2 border-black text-white rounded-full text-sm font-medium hover:bg-opacity-90 transition-colors shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none">Return</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Books -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="p-4 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-text">Recent Books</h2>
            <a href="{{ route('book.create') }}" class="px-3 py-1.5 bg-primary border-2 border-black text-text rounded-full text-sm font-medium hover:bg-opacity-90 transition-colors shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Book
            </a>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Chart variables
            let borrowChartInstance = null;
            let categoriesChartInstance = null;
            let borrowChartType = 'pie';
            let categoryChartType = 'doughnut';
            
            // Initialize charts
            initBorrowChart();
            initCategoriesChart();

            // Initialize filters
            initRequestFilter();
            
            // Borrow Status Chart
            function initBorrowChart() {
                const borrowCtx = document.getElementById('borrowChart').getContext('2d');
                
                if (borrowChartInstance) {
                    borrowChartInstance.destroy();
                }
                
                borrowChartInstance = new Chart(borrowCtx, {
                    type: borrowChartType,
                    data: {
                        labels: ['Pending', 'Borrowed', 'Returned', 'Rejected'],
                        datasets: [{
                            data: [{{ $pendingRequests }}, {{ $borrowedCount }}, {{ $returnedCount ?? 0 }}, {{ $rejectedCount }}],
                            backgroundColor: [
                                '#FBBF24',
                                '#10B981',
                                '#3B82F6',
                                '#EF4444'
                            ],
                            borderColor: [
                                '#F59E0B',
                                '#059669',
                                '#2563EB',
                                '#DC2626'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: ${value} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Book Categories Chart
            function initCategoriesChart() {
                const categoriesCtx = document.getElementById('categoriesChart').getContext('2d');
                
                if (categoriesChartInstance) {
                    categoriesChartInstance.destroy();
                }
                
                categoriesChartInstance = new Chart(categoriesCtx, {
                    type: categoryChartType,
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
                                '#6366F1',
                                '#10B981',
                                '#EF4444',
                                '#14B8A6',
                                '#F97316'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: ${value} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Initialize request filter
            function initRequestFilter() {
                const requestFilter = document.getElementById('requestFilter');
                const rows = document.querySelectorAll('.request-row');
                
                requestFilter.addEventListener('change', function() {
                    const status = this.value;
                    
                    rows.forEach(row => {
                        if (status === 'all' || row.dataset.status === status) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
            
            // Toggle borrow chart type
            document.getElementById('borrowChartType').addEventListener('click', function() {
                borrowChartType = borrowChartType === 'pie' ? 'bar' : 'pie';
                this.textContent = `Switch to ${borrowChartType === 'pie' ? 'Bar' : 'Pie'}`;
                initBorrowChart();
            });
            
            // Toggle category chart type
            document.getElementById('categoryChartType').addEventListener('click', function() {
                categoryChartType = categoryChartType === 'doughnut' ? 'bar' : 'doughnut';
                this.textContent = `Switch to ${categoryChartType === 'doughnut' ? 'Bar' : 'Doughnut'}`;
                initCategoriesChart();
            });
            
            // Category sort
            document.getElementById('categorySort').addEventListener('change', function() {
                const sortType = this.value;
                const labels = {!! json_encode($categoryLabels) !!};
                const data = {!! json_encode($categoryData) !!};
                
                // Create pairs of label and data for sorting
                let pairs = labels.map((label, i) => {
                    return { label: label, data: data[i] };
                });
                
                // Sort based on selection
                if (sortType === 'alphabetical') {
                    pairs.sort((a, b) => a.label.localeCompare(b.label));
                } else {
                    pairs.sort((a, b) => b.data - a.data);
                }
                
                // Update chart data
                categoriesChartInstance.data.labels = pairs.map(pair => pair.label);
                categoriesChartInstance.data.datasets[0].data = pairs.map(pair => pair.data);
                categoriesChartInstance.update();
            });
            
            // Refresh dashboard
            document.getElementById('refreshDashboard').addEventListener('click', function() {
                window.location.reload();
            });
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