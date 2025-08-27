<!-- Sidebar Component -->
<div x-data="{
    open: window.innerWidth >= 1024,
    toggle() {
        this.open = !this.open;
        // Persist state in localStorage
        localStorage.setItem('sidebarState', this.open ? 'open' : 'closed');
    },
    init() {
        // Restore state from localStorage
        const savedState = localStorage.getItem('sidebarState');
        if (savedState) {
            this.open = savedState === 'open';
        }
        
        // Handle responsive behavior
        this.$watch('open', value => {
            if (window.innerWidth < 1024 && value) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = 'auto';
            }
        });
        
        // Close sidebar on mobile when clicking outside
        if (window.innerWidth < 1024) {
            this.open = false;
            document.addEventListener('click', (e) => {
                if (this.open && !this.$el.contains(e.target)) {
                    this.open = false;
                }
            });
        }
    }
}" 
class="flex h-screen bg-gray-100 dark:bg-gray-900"
:class="{'overflow-hidden': open && window.innerWidth < 1024}">
    
    <!-- Mobile Overlay -->
    <div x-show="open && window.innerWidth < 1024" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-20 bg-gray-900 bg-opacity-50 lg:hidden"
         @click="open = false">
    </div>

    <!-- Sidebar -->
    <aside :class="open ? 'w-64 translate-x-0' : '-translate-x-full lg:translate-x-0 lg:w-20'" 
           class="bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-all duration-300 flex flex-col fixed lg:relative z-30 h-full transform">
        
        <!-- Logo Area -->
        <div class="flex items-center justify-between h-16 px-4 shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center min-w-max">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                <span x-show="open" class="ml-2 text-xl font-semibold whitespace-nowrap">App</span>
            </a>
            <button @click="toggle()" 
                    class="p-1 rounded-md text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    :aria-label="open ? 'Collapse sidebar' : 'Expand sidebar'">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"/>
                </svg>
                <span x-show="open">{{ __('Dashboard') }}</span>
            </x-nav-link>
            
            <!-- Additional menu items can be added here -->
        </nav>

        <!-- User Section -->
        <div class="border-t border-gray-200 dark:border-gray-700 p-4 shrink-0">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="w-full flex items-center justify-between px-3 py-2 rounded-md 
                                   text-sm font-medium text-gray-600 dark:text-gray-300 
                                   hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <div class="flex items-center min-w-0">
                            <div class="h-8 w-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-sm font-medium mr-2 shrink-0">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span x-show="open" class="truncate">{{ Auth::user()->name }}</span>
                        </div>
                        <svg x-show="open" class="w-4 h-4 ml-2 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" 
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 lg:ml-0 transition-margin duration-300"
         :class="open ? 'lg:ml-64' : 'lg:ml-20'">
        <!-- Mobile header -->
        <div class="lg:hidden bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 p-4">
            <button @click="open = true" class="p-1 rounded-md text-gray-500 dark:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" 
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
        
        <!-- Content -->
        <main class="flex-1 p-4 lg:p-6 overflow-auto">
            @yield('content')
        </main>
    </div>
</div>

<style>
    /* Custom scrollbar for sidebar */
    nav::-webkit-scrollbar {
        width: 4px;
    }
    
    nav::-webkit-scrollbar-track {
        background: transparent;
    }
    
    nav::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 2px;
    }
    
    .dark nav::-webkit-scrollbar-thumb {
        background: #475569;
    }
    
    /* Smooth transitions */
    .transition-margin {
        transition-property: margin;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>