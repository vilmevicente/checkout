<!-- Sidebar -->
<div x-data="{ open: true }" class="flex h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Sidebar -->
    <aside :class="open ? 'w-64' : 'w-20'" 
           class="bg-white  dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-all duration-300 flex flex-col">

        <!-- Logo -->
        <div class="flex items-center justify-between h-16 px-4">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
            <button @click="open = !open" class="text-gray-500 dark:text-gray-400 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" 
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-2 py-4 space-y-2">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block">
                {{ __('Dashboard') }}
            </x-nav-link>
        </nav>

      
    </aside>

    <!-- Main Content -->
    <div class="flex-1">
        @yield('content')
    </div>
</div>
