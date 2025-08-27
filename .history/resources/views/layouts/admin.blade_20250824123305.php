<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">{{ config('app.name') }}</h1>
                <p class="text-gray-400">Admin Dashboard</p>
            </div>
            <nav class="mt-6">
                <x-admin-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                    Dashboard
                </x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.banners.index') }}" :active="request()->routeIs('admin.banners.*')">
                    Banners
                </x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.upsells.index') }}" :active="request()->routeIs('admin.upsells.*')">
                    Upsells
                </x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.config.edit') }}" :active="request()->routeIs('admin.config.*')">
                    Configurações
                </x-admin-nav-link>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <h2 class="text-xl font-semibold text-gray-900">
                        @yield('title')
                    </h2>
                </div>
            </header>

            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>