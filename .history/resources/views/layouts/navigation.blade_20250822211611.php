<div x-data="{ open: false }" class="flex">
    <!-- Sidebar -->
    <aside
        :class="open ? 'translate-x-0' : '-translate-x-64'"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transform transition-transform duration-300 ease-in-out flex flex-col max-h-screen"
    >
        <!-- Logo + Toggle -->
        <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200 dark:border-gray-700">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
            <button @click="open = false" class="sm:hidden text-gray-500 dark:text-gray-400 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Menu com scroll -->
        <nav class="flex-1 overflow-y-auto px-2 py-4 space-y-2">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block">
                {{ __('Dashboard') }}
            </x-nav-link>
            <!-- + outros links -->
        </nav>

        <!-- User Dropdown fixado em baixo -->
        <div class="border-t border-gray-200 dark:border-gray-700 p-4 relative">
            <div x-data="{ userMenu: false }" class="relative">
                <button @click="userMenu = !userMenu"
                    class="w-full flex items-center justify-between px-3 py-2 rounded-md 
                           text-sm font-medium text-gray-600 dark:text-gray-300 
                           hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="userMenu" @click.away="userMenu = false"
                     class="absolute bottom-12 left-0 w-full bg-white dark:bg-gray-800 border 
                            border-gray-200 dark:border-gray-700 rounded-md shadow-lg py-1 z-50">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Overlay no mobile -->
    <div x-show="open" @click="open = false"
         class="fixed inset-0 bg-black bg-opacity-50 z-40 sm:hidden"></div>

    <!-- Conteúdo principal -->
    <div class="flex-1 flex flex-col sm:ml-64 transition-all">
        <!-- Botão toggle mobile -->
        <div class="sm:hidden p-4">
            <button @click="open = true"
                class="p-2 rounded-md text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
        
        <!-- Aqui vem o header e conteúdo -->
        {{ $slot ?? '' }}
    </div>
</div>
