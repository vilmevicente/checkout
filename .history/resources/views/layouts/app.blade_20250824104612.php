<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ 
        darkMode: localStorage.getItem('theme') === 'dark',
        sidebarOpen: true,
        sections: {
            apps: false,
            appsEmail: false,
            appsInvoices: false,
            appsContacts: false,
            appsBlog: false,
            auth: false,
            pages: false,
            components: false,
            extended: false,
            forms: false,
            tables: false,
            charts: false,
            icons: false,
            maps: false,
            multi: false,
        }
      }"
      x-init="
        // Initialize theme
        if (darkMode) {
          document.documentElement.classList.add('dark');
        } else {
          document.documentElement.classList.remove('dark');
        }
      "
      x-bind:class="{ 'dark': darkMode }"
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .submenu-link {
                @apply flex items-center gap-3 py-2 px-3 rounded-md text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-violet-600 hover:bg-violet-50/70 dark:hover:bg-gray-700 transition;
            }
            
            .submenu-toggle {
                @apply w-full flex items-center justify-between py-2 px-3 rounded-md text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-violet-600 hover:bg-violet-50/70 dark:hover:bg-gray-700 transition;
            }
            
            .menu-toggle {
                @apply w-full flex items-center justify-between py-2.5 px-3 rounded-md text-sm font-medium text-gray-900 dark:text-gray-200 hover:text-violet-600 hover:bg-violet-50/70 dark:hover:bg-gray-700 transition;
            }
            
            .submenu {
                @apply mt-1 space-y-1 pl-9;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <aside
                class="fixed top-0 bottom-0 ltr:left-0 rtl:right-0 z-10 border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800 ltr:border-r rtl:border-l print:hidden transition-all duration-300"
                :class="sidebarOpen ? 'w-64' : 'w-20'"
            >
                <!-- Scroll interno -->
                <div class="h-full overflow-y-auto">
                    <!-- Logo and Toggle -->
                    <div class="h-[70px] flex items-center px-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('dashboard') }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                            </a>
                            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 dark:text-gray-300 hover:opacity-80">
                                <!-- Heroicon menu -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Título do Menu -->
                    <div class="px-5 py-3 text-xs font-medium text-gray-500 cursor-default leading-4" :class="!sidebarOpen ? 'hidden' : ''">
                        {{ __('Menu') }}
                    </div>

                    <!-- Lista -->
                    <nav class="px-2 pb-8">
                        <ul class="space-y-1">
                            <!-- Dashboard -->
                            <li>
                                <a href="{{ route('dashboard') }}"
                                   @class([
                                       'flex items-center gap-3 py-2.5 px-3 rounded-md text-sm font-medium transition',
                                       'text-violet-600 bg-violet-50 dark:bg-violet-500/10' => request()->routeIs('dashboard'),
                                       'text-gray-900 dark:text-gray-200 hover:text-violet-600 hover:bg-violet-50/70 dark:hover:bg-gray-700' => !request()->routeIs('dashboard'),
                                   ])>
                                    <!-- Ícone -->
                                    <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"/>
                                    </svg>
                                    <span x-show="sidebarOpen" class="truncate">{{ __('Dashboard') }}</span>
                                </a>
                            </li>

                            <!-- Apps -->
                            <li>
                                <button
                                    @click="sections.apps = !sections.apps"
                                    class="w-full flex items-center justify-between py-2.5 px-3 rounded-md text-sm font-medium text-gray-900 dark:text-gray-200 hover:text-violet-600 hover:bg-violet-50/70 dark:hover:bg-gray-700 transition"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4 6h4v4H4V6zm6 0h4v4h-4V6zm6 0h4v4h-4V6zM4 12h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4z"/>
                                        </svg>
                                        <span x-show="sidebarOpen" class="truncate">Apps</span>
                                    </div>
                                    <svg x-show="sidebarOpen" :class="sections.apps ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <!-- Submenu Apps -->
                                <ul x-show="sections.apps && sidebarOpen" x-transition.opacity class="mt-1 space-y-1 pl-3 border-l border-gray-100 dark:border-gray-700">
                                    <li>
                                        <a href="{{ url('/app-calendar') }}" class="submenu-link">
                                            <span>Calendar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/app-chat') }}" class="submenu-link">
                                            <span>Chat</span>
                                        </a>
                                    </li>

                                    <!-- Email -->
                                    <li>
                                        <button @click="sections.appsEmail = !sections.appsEmail" class="submenu-toggle">
                                            <span>Email</span>
                                            <svg :class="sections.appsEmail ? 'rotate-180' : ''" class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>
                                        <ul x-show="sections.appsEmail" x-transition.opacity class="mt-1 space-y-1 pl-3 border-l border-gray-100 dark:border-gray-700">
                                            <li><a href="{{ url('/apps-email-inbox') }}" class="submenu-link"><span>Inbox</span></a></li>
                                            <li><a href="{{ url('/apps-email-read') }}" class="submenu-link"><span>Read Email</span></a></li>
                                        </ul>
                                    </li>

                                    <!-- Continue with other menu items... -->
                                    <!-- I've condensed this section for brevity but you should include all your menu items here -->
                                    
                                </ul>
                            </li>
                            
                            <!-- Continue with the rest of your navigation items -->
                            <!-- ... -->
                            
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col" :class="sidebarOpen ? 'ltr:ml-64 rtl:mr-64' : 'ltr:ml-20 rtl:mr-20'">
                
                <!-- Topbar -->
                <div class="h-[70px] flex items-center px-4 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 dark:text-gray-300 hover:opacity-80">
                        <!-- Heroicon menu -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <!-- Darkmode + User -->
                    <div class="ml-auto flex items-center gap-4">
                        <!-- Toggle Darkmode -->
                        <button @click="darkMode = !darkMode;
                                        if(darkMode){localStorage.setItem('theme','dark')}
                                        else{localStorage.setItem('theme','light')}"
                                class="px-3 py-2 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 transition">
                            <span x-show="!darkMode">🌙</span>
                            <span x-show="darkMode">☀️</span>
                        </button>

                        <!-- Nome do user -->
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ Auth::user()->name }}
                        </span>
                    </div>
                </div>

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1 overflow-auto">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>