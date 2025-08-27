<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ 
        darkMode: localStorage.getItem('theme') === 'dark',
        sidebarOpen: true,
        userDropdownOpen: false,
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
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            @include('layouts.navigation')

            <!-- Conteúdo principal -->
            <div class="flex-1 flex flex-col">
                
                <!-- Topbar com toggle -->
                <div class="h-[70px] flex items-center px-4 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                  
                

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
                <main class="flex-1">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>