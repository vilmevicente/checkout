<div 
    x-data="{ open: true }" 
    class="flex h-screen"
>
    <!-- Sidebar -->
    <div 
        :class="open ? 'w-64' : 'w-20'" 
        class="bg-gray-900 text-gray-100 transition-all duration-300 flex flex-col"
    >
        <!-- Top bar com botão para encolher -->
        <div class="flex items-center justify-between p-4 border-b border-gray-700">
            <span x-show="open" class="text-lg font-bold">Painel</span>
            <button 
                @click="open = !open" 
                class="p-2 rounded hover:bg-gray-800 transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Menu -->
        <nav class="flex-1 p-2 space-y-2">
            <!-- Home -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 p-2 rounded hover:bg-gray-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 4l9 5.75M12 22V12m0 0L3 9.75M12 12l9-2.25"/>
                </svg>
                <span x-show="open">Home</span>
            </a>

            <!-- Banners -->
            <a href="{{ route('banners.index') }}" class="flex items-center space-x-3 p-2 rounded hover:bg-gray-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
                <span x-show="open">Banners</span>
            </a>

            <!-- Upsellers -->
            <a href="{{ route('upsellers.index') }}" class="flex items-center space-x-3 p-2 rounded hover:bg-gray-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span x-show="open">Upsellers</span>
            </a>

            <!-- Config -->
            <a href="{{ route('config.index') }}" class="flex items-center space-x-3 p-2 rounded hover:bg-gray-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a4 4 0 114 4h-2m-2 0v2a4 4 0 11-4-4h2z"/>
                </svg>
                <span x-show="open">Config</span>
            </a>
        </nav>

        <!-- Tema e User -->
        <div class="p-4 border-t border-gray-700">
            <button class="w-full flex items-center justify-center space-x-2 p-2 rounded hover:bg-gray-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v9m0 0l3-3m-3 3l-3-3m9 9a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span x-show="open">Alterar Tema</span>
            </button>
        </div>
    </div>

    <!-- Conteúdo -->
    <div class="flex-1 bg-gray-100 p-6">
        @yield('content')
    </div>
</div>
