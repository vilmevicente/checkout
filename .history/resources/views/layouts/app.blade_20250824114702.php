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
                      <!-- User -->
        <div class="border-t border-gray-200 dark:border-gray-700 p-4">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="w-full flex items-center justify-between px-3 py-2 rounded-md 
                                   text-sm font-medium text-gray-600 dark:text-gray-300 
                                   hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" 
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

                    <!-- Logout -->
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