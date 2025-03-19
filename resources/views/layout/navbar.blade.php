<div class="flex justify-between items-center px-6 py-4 shadow-md bg-white border-b-2 border-gray-100">
    {{-- Logo --}}
    <a href="/" class="font-bold text-3xl tracking-tight text-text hover:text-primary transition-colors duration-200 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
        </svg>
        BooKoo
    </a>

    {{-- Navigations --}}
    <nav class="flex gap-4 items-center">
        @auth
            <a href="{{ route('dashboard.index') }}" class="px-4 py-2 bg-secondary border-2 border-black text-text rounded-full font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                </svg>
                Dashboard
            </a>
            
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-text font-bold border-2 border-black">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <span class="font-medium hidden md:block">{{ auth()->user()->name }}</span>
                </div>
                
                <form action={{route('logout')}} method="POST">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 bg-red-500 border-2 border-black text-white rounded-full text-sm font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none">
                        Logout
                    </button>
                </form>
            </div>
        @else
            <a href={{route('sign-in-form')}} class="px-4 py-2 bg-gray-100 text-text rounded-full font-medium hover:bg-gray-200 transition-all duration-200 shadow-[0_3px_0_0_#d1d5db] hover:shadow-[0_1px_0_0_#d1d5db] hover:translate-y-0.5 active:translate-y-1 active:shadow-none">
                Sign In
            </a>
            <a href={{route('sign-up-form')}} class="px-4 py-2 bg-primary border-2 border-black text-text rounded-full font-medium hover:bg-opacity-90 transition-all duration-200 shadow-[0_3px_0_0_#000000] hover:shadow-[0_1px_0_0_#000000] hover:translate-y-0.5 active:translate-y-1 active:shadow-none">
                Sign Up
            </a>
        @endauth
    </nav>
</div>