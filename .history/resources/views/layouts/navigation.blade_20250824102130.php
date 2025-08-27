<!-- Sidebar + Content -->
<div 
    x-data="{
        open: true,
        darkMode: localStorage.getItem('theme') === 'dark',
        sections: {
            apps: false, appsEmail: false, appsInvoices: false, appsContacts: false, appsBlog: false,
            auth: false, pages: false, components: false, extended: false, forms: false,
            tables: false, charts: false, icons: false, maps: false, multi: false,
        },
        toggleDark() {
            this.darkMode = !this.darkMode
            if (this.darkMode) {
                document.documentElement.classList.add('dark')
                localStorage.setItem('theme', 'dark')
            } else {
                document.documentElement.classList.remove('dark')
                localStorage.setItem('theme', 'light')
            }
        }
    }"
    x-init="if (darkMode) document.documentElement.classList.add('dark')"
    class="min-h-screen bg-gray-100 dark:bg-gray-900"
>
    <!-- Top Navbar -->
    <div class="h-[70px] flex items-center px-4 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
            <button @click="open = !open" class="text-gray-600 dark:text-gray-300 hover:opacity-80">
                <!-- Menu Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Botão Dark/Light -->
        <div class="ml-4">
            <button @click="toggleDark()" class="p-2 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 transition">
                <template x-if="!darkMode">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.485-8.485h1M3.515 12H2.5m15.364-7.071l.707.707M5.636 18.364l-.707.707m12.728 0l.707-.707M5.636 5.636l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                    </svg>
                </template>
                <template x-if="darkMode">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                    </svg>
                </template>
            </button>
        </div>

        <!-- User dropdown -->
        <div class="ml-auto">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content">
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
                </x-slot>
            </x-dropdown>
        </div>
    </div>

    <!-- Sidebar -->
    <aside
        class="fixed top-[70px] bottom-0 ltr:left-0 rtl:right-0 z-10 border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800 ltr:border-r rtl:border-l print:hidden transition-all duration-300"
        :class="open ? 'w-64' : 'w-20'"
    >
        <!-- Conteúdo Sidebar -->
        <div class="h-full overflow-y-auto">
            <div class="px-5 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 cursor-default leading-4">
                {{ __('Menu') }}
            </div>

            <nav class="px-2 pb-8">
                <ul class="space-y-1">
                    <!-- Exemplo de Item -->
                    <li>
                        <a href="{{ route('dashboard') }}"
                           @class([
                               'flex items-center gap-3 py-2.5 px-3 rounded-md text-sm font-medium transition',
                               'text-violet-600 bg-violet-50 dark:bg-violet-500/10' => request()->routeIs('dashboard'),
                               'text-gray-900 dark:text-gray-200 hover:text-violet-600 hover:bg-violet-50/70 dark:hover:bg-gray-700' => !request()->routeIs('dashboard'),
                           ])>
                            <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"/>
                            </svg>
                            <span x-show="open" class="truncate">{{ __('Dashboard') }}</span>
                        </a>
                    </li>

                    <!-- Aqui entram os outros menus (Apps, Auth, Pages, etc.) -->
                    <!-- ... -->
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Conteúdo Principal -->
    <main class="ltr:ml-64 rtl:mr-64 p-6 transition-all" :class="open ? 'ltr:ml-64 rtl:mr-64' : 'ltr:ml-20 rtl:mr-20'">
        {{ $slot }}
    </main>
</div>
