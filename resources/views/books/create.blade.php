@extends('layout.app')

@section('title')
    New Book
@endsection

@section('content')
<section class="p-6 md:p-8 max-w-5xl mx-auto">
    <div class="flex flex-col gap-6">
        <!-- Header and Back Button -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-text">Add New Book</h1>
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-100 text-text rounded-full font-medium hover:bg-gray-200 transition-all duration-200 shadow-[0_3px_0_0_#d1d5db] hover:shadow-[0_1px_0_0_#d1d5db] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back
            </a>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
        <div class="space-y-2">
            @foreach ($errors->all() as $error)
            <div class="p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg font-medium flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $error }}
            </div>
            @endforeach
        </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="flex flex-col gap-6">
                        <!-- Book Title -->
                        <div class="flex flex-col gap-2">
                            <label for="title" class="font-semibold text-text flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                </svg>
                                Book Title
                                <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                class="border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200" 
                                placeholder="Enter book title" 
                                required
                            />
                        </div>

                        <!-- Author -->
                        <div class="flex flex-col gap-2">
                            <label for="author" class="font-semibold text-text flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Author
                                <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="author" 
                                id="author" 
                                class="border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200" 
                                placeholder="Enter author name" 
                                required
                            />
                        </div>

                        <!-- Published Year -->
                        <div class="flex flex-col gap-2">
                            <label for="published_year" class="font-semibold text-text flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                Publication Year
                                <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="number" 
                                name="published_year" 
                                id="published_year" 
                                min="1000" 
                                max="{{ date('Y') }}" 
                                class="border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200" 
                                placeholder="Enter publication year" 
                                required
                            />
                        </div>

                        <!-- Page Count -->
                        <div class="flex flex-col gap-2">
                            <label for="page_count" class="font-semibold text-text flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
                                    <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                                </svg>
                                Page Count
                                <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="number" 
                                name="page_count" 
                                id="page_count" 
                                min="1" 
                                class="border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200" 
                                placeholder="Enter number of pages" 
                                required
                            />
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="flex flex-col gap-6">
                        <!-- Book Description -->
                        <div class="flex flex-col gap-2">
                            <label for="description" class="font-semibold text-text flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                </svg>
                                Description
                                <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                name="description" 
                                id="description" 
                                rows="5" 
                                class="border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200" 
                                placeholder="Enter book description"
                                required
                            ></textarea>
                        </div>

                        <!-- Additional Fields (Optional) -->
                        <div class="flex flex-col gap-2">
                            <label for="category" class="font-semibold text-text flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                                Category
                            </label>
                            <select name="category" id="category" class="border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200">
                                <option value="">Select a category</option>
                                <option value="Fiction">Fiction</option>
                                <option value="Non-Fiction">Non-Fiction</option>
                                <option value="Science">Science</option>
                                <option value="Technology">Technology</option>
                                <option value="History">History</option>
                                <option value="Biography">Biography</option>
                                <option value="Self-Help">Self-Help</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <!-- Book Cover Image -->
                        <div class="flex flex-col gap-2">
                            <label for="image" class="font-semibold text-text flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                </svg>
                                Book Cover
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="flex flex-col gap-2">
                                <div class="bg-gray-50 border border-gray-300 rounded-lg p-4 text-center relative">
                                    <input 
                                        type="file" 
                                        accept="image/*" 
                                        name="image" 
                                        id="image" 
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" 
                                        required
                                    />
                                    <div class="flex flex-col items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-gray-500">Click to upload book cover image</span>
                                        <span class="text-xs text-gray-400">(Recommended size: 400x600px)</span>
                                    </div>
                                </div>
                                <div id="image-preview" class="hidden rounded-lg overflow-hidden border border-gray-200">
                                    <img src="#" alt="Image preview" class="w-full h-auto" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 flex justify-end">
                    <button 
                        type="submit" 
                        class="px-6 py-3 bg-primary border-2 border-black text-text rounded-full font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_4px_0_0_#000000] hover:shadow-[0_2px_0_0_#86c0ae] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                        </svg>
                        Add New Book
                    </button>
                </div>
            </form>
        </div>

        <!-- Form Guidelines -->
        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-md">
            <h3 class="font-semibold text-text mb-2 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                </svg>
                Guidelines for Adding Books
            </h3>
            <ul class="list-disc list-inside text-gray-700 space-y-1 pl-2">
                <li>Make sure the book information is accurate and complete.</li>
                <li>Upload clear, high-quality images of book covers.</li>
                <li>Provide a comprehensive description that helps readers understand what the book is about.</li>
                <li>Double-check the publication year and page count for accuracy.</li>
            </ul>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');
    
    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.querySelector('img').src = e.target.result;
                imagePreview.classList.remove('hidden');
            };
            
            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>
@endsection