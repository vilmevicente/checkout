<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard com Sidebar Responsivo</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('sidebar', {
                open: window.innerWidth > 768,
                isDesktop: window.innerWidth > 768,
                
                init() {
                    window.addEventListener('resize', () => {
                        this.isDesktop = window.innerWidth > 768;
                        if (this.isDesktop) {
                            this.open = true;
                        } else {
                            this.open = false;
                        }
                    });
                },
                
                toggle() {
                    if (!this.isDesktop) {
                        this.open = !this.open;
                    }
                }
            });
        });
    </script>
    <style>
        :root {
            --sidebar-width: 16rem;
            --sidebar-collapsed-width: 5rem;
            --topbar-height: 4.375rem;
            --transition-speed: 0.3s;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            transition: background-color var(--transition-speed);
        }
        
        body.dark {
            background-color: #111827;
            color: #e5e7eb;
        }
        
        /* Layout principal */
        .app-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid #e5e7eb;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            transition: width var(--transition-speed), transform var(--transition-speed);
            z-index: 40;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        
        .dark .sidebar {
            background: #1f2937;
            border-right-color: #374151;
        }
        
        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }
        
        /* Conteúdo principal */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left var(--transition-speed);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .main-content.collapsed {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        /* Topbar */
        .topbar {
            height: var(--topbar-height);
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 30;
        }
        
        .dark .topbar {
            background: #1f2937;
            border-bottom-color: #374151;
        }
        
        /* Conteúdo da página */
        .page-content {
            flex: 1;
            padding: 1.5rem;
        }
        
        /* Logo */
        .logo {
            height: 2.25rem;
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .dark .logo {
            border-bottom-color: #374151;
        }
        
        .logo img {
            height: 2rem;
            width: auto;
        }
        
        /* Navegação */
        .nav-menu {
            padding: 0.5rem;
            flex: 1;
            overflow-y: auto;
        }
        
        .menu-title {
            padding: 0.75rem 1rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 500;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .dark .menu-title {
            color: #9ca3af;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            color: #4b5563;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
            margin-bottom: 0.25rem;
        }
        
        .dark .menu-item {
            color: #d1d5db;
        }
        
        .menu-item:hover {
            background-color: #f3f4f6;
            color: #4f46e5;
        }
        
        .dark .menu-item:hover {
            background-color: #374151;
            color: #818cf8;
        }
        
        .menu-item.active {
            background-color: #eef2ff;
            color: #4f46e5;
        }
        
        .dark .menu-item.active {
            background-color: #312e81;
            color: #a5b4fc;
        }
        
        .menu-icon {
            margin-right: 0.75rem;
            width: 1.25rem;
            height: 1.25rem;
            flex-shrink: 0;
        }
        
        .menu-text {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .menu-arrow {
            transition: transform 0.2s;
        }
        
        .menu-arrow.rotated {
            transform: rotate(180deg);
        }
        
        /* Submenu */
        .submenu {
            padding-left: 2.25rem;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        
        .submenu-item {
            padding: 0.6rem 1rem;
            border-radius: 0.375rem;
            color: #6b7280;
            font-size: 0.875rem;
            transition: all 0.2s;
            cursor: pointer;
        }
        
        .dark .submenu-item {
            color: #9ca3af;
        }
        
        .submenu-item:hover {
            color: #4f46e5;
        }
        
        .dark .submenu-item:hover {
            color: #818cf8;
        }
        
        /* User section */
        .user-section {
            border-top: 1px solid #e5e7eb;
            padding: 1rem;
            margin-top: auto;
        }
        
        .dark .user-section {
            border-top-color: #374151;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .user-info:hover {
            background-color: #f3f4f6;
        }
        
        .dark .user-info:hover {
            background-color: #374151;
        }
        
        .user-avatar {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            background-color: #4f46e5;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }
        
        .user-details {
            flex: 1;
            overflow: hidden;
        }
        
        .user-name {
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .user-role {
            font-size: 0.75rem;
            color: #6b7280;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .dark .user-role {
            color: #9ca3af;
        }
        
        /* User dropdown */
        .user-dropdown {
            position: absolute;
            bottom: 4.5rem;
            left: 1rem;
            right: 1rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            z-index: 50;
        }
        
        .dark .user-dropdown {
            background: #374151;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3), 0 2px 4px -1px rgba(0, 0, 0, 0.2);
        }
        
        .dropdown-item {
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            color: #4b5563;
            transition: background-color 0.2s;
            cursor: pointer;
        }
        
        .dark .dropdown-item {
            color: #d1d5db;
        }
        
        .dropdown-item:hover {
            background-color: #f3f4f6;
        }
        
        .dark .dropdown-item:hover {
            background-color: #4b5563;
        }
        
        .dropdown-icon {
            width: 1.25rem;
            height: 1.25rem;
            margin-right: 0.75rem;
        }
        
        /* Toggle button */
        .sidebar-toggle {
            position: absolute;
            top: 1rem;
            right: -0.75rem;
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 50%;
            background: white;
            border: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        
        .dark .sidebar-toggle {
            background: #1f2937;
            border-color: #374151;
        }
        
        /* Cards no dashboard */
        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .dark .card {
            background: #1f2937;
        }
        
        .card-header {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        /* Responsividade */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0 !important;
            }
            
            .sidebar-toggle {
                display: none;
            }
            
            .mobile-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 30;
            }
            
            .mobile-overlay.open {
                display: block;
            }
        }
        
        /* Utilitários */
        .hidden-item {
            display: none;
        }
        
        .flex-between {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .text-sm {
            font-size: 0.875rem;
        }
        
        .text-xs {
            font-size: 0.75rem;
        }
    </style>
</head>
<body x-data="{
        darkMode: localStorage.getItem('theme') === 'dark',
        sidebarOpen: window.innerWidth > 768,
        userDropdownOpen: false,
        activeSubmenus: {},
        toggleSubmenu(key) {
            this.activeSubmenus[key] = !this.activeSubmenus[key];
            this.$nextTick(() => {
                this.activeSubmenus = {...this.activeSubmenus};
            });
        }
    }" 
    x-init="
        if (darkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        
        // Inicializar submenus
        $nextTick(() => {
            activeSubmenus = {
                apps: false,
                auth: false,
                pages: false,
                components: false,
                extended: false,
                forms: false,
                tables: false,
                charts: false,
                icons: false,
                maps: false,
                multi: false
            };
        });
    "
    :class="{ 'dark': darkMode }"
>
    <div class="app-container">
        <!-- Overlay para mobile -->
        <div class="mobile-overlay" :class="{ 'open': sidebarOpen && window.innerWidth <= 768 }" 
             @click="sidebarOpen = false"></div>
        
        <!-- Sidebar -->
        <aside class="sidebar" :class="{ 'collapsed': !sidebarOpen && window.innerWidth > 768 }">
            <!-- Logo -->
            <div class="logo">
                <svg class="h-8 w-auto text-indigo-600" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.6667 6.66667C14.6667 5.19391 15.8605 4 17.3333 4H24C25.4728 4 26.6667 5.19391 26.6667 6.66667V13.3333C26.6667 14.8061 25.4728 16 24 16H17.3333C15.8605 16 14.6667 14.8061 14.6667 13.3333V6.66667Z" fill="#4F46E5"/>
                    <path d="M5.33333 16C5.33333 14.5272 6.52724 13.3333 8 13.3333H14.6667C16.1395 13.3333 17.3333 14.5272 17.3333 16V22.6667C17.3333 24.1395 16.1395 25.3333 14.6667 25.3333H8C6.52724 25.3333 5.33333 24.1395 5.33333 22.6667V16Z" fill="#4F46E5"/>
                    <path d="M18.6667 19.3333C18.6667 17.8605 19.8605 16.6667 21.3333 16.6667H28C29.4728 16.6667 30.6667 17.8605 30.6667 19.3333V26C30.6667 27.4728 29.4728 28.6667 28 28.6667H21.3333C19.8605 28.6667 18.6667 27.4728 18.6667 26V19.3333Z" fill="#4F46E5"/>
                    <path d="M1.33333 9.33333C1.33333 7.86057 2.52724 6.66667 4 6.66667H10.6667C12.1395 6.66667 13.3333 7.86057 13.3333 9.33333V16C13.3333 17.4728 12.1395 18.6667 10.6667 18.6667H4C2.52724 18.6667 1.33333 17.4728 1.33333 16V9.33333Z" fill="#4F46E5"/>
                </svg>
                <span class="menu-text ml-2 font-semibold" x-show="sidebarOpen || window.innerWidth <= 768">AdminPanel</span>
            </div>
            
            <!-- Menu de Navegação -->
            <nav class="nav-menu">
                <div class="menu-title" x-show="sidebarOpen || window.innerWidth <= 768">Menu</div>
                
                <!-- Dashboard -->
                <div class="menu-item active">
                    <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"/>
                    </svg>
                    <span class="menu-text" x-show="sidebarOpen || window.innerWidth <= 768">Dashboard</span>
                </div>
                
                <!-- Apps -->
                <div class="menu-item" @click="toggleSubmenu('apps')">
                    <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <span class="menu-text" x-show="sidebarOpen || window.innerWidth <= 768">Apps</span>
                    <svg class="menu-arrow" :class="{ 'rotated': activeSubmenus.apps }" 
                         x-show="sidebarOpen || window.innerWidth <= 768" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
                
                <!-- Submenu Apps (visível apenas quando expandido) -->
                <div class="submenu" x-show="activeSubmenus.apps && (sidebarOpen || window.innerWidth <= 768)" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div class="submenu-item">Calendar</div>
                    <div class="submenu-item">Chat</div>
                    <div class="submenu-item">Email</div>
                    <div class="submenu-item">Invoices</div>
                    <div class="submenu-item">Contacts</div>
                    <div class="submenu-item">Blog</div>
                </div>
                
                <!-- Authentication -->
                <div class="menu-item" @click="toggleSubmenu('auth')">
                    <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span class="menu-text" x-show="sidebarOpen || window.innerWidth <= 768">Authentication</span>
                    <svg class="menu-arrow" :class="{ 'rotated': activeSubmenus.auth }" 
                         x-show="sidebarOpen || window.innerWidth <= 768" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
                
                <!-- Pages -->
                <div class="menu-item" @click="toggleSubmenu('pages')">
                    <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="menu-text" x-show="sidebarOpen || window.innerWidth <= 768">Pages</span>
                    <svg class="menu-arrow" :class="{ 'rotated': activeSubmenus.pages }" 
                         x-show="sidebarOpen || window.innerWidth <= 768" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
                
                <!-- Mais itens do menu... -->
            </nav>
            
            <!-- User Section -->
            <div class="user-section">
                <div class="user-info" @click="userDropdownOpen = !userDropdownOpen">
                    <div class="user-avatar">JD</div>
                    <div class="user-details" x-show="sidebarOpen || window.innerWidth <= 768">
                        <div class="user-name">John Doe</div>
                        <div class="user-role">Administrator</div>
                    </div>
                    <svg x-show="sidebarOpen || window.innerWidth <= 768" class="menu-arrow" :class="{ 'rotated': userDropdownOpen }" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
                
                <!-- User Dropdown -->
                <div class="user-dropdown" x-show="userDropdownOpen && (sidebarOpen || window.innerWidth <= 768)" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div class="dropdown-item">
                        <svg class="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>Profile</span>
                    </div>
                    <div class="dropdown-item">
                        <svg class="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Settings</span>
                    </div>
                    <div class="dropdown-item">
                        <svg class="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Logout</span>
                    </div>
                </div>
            </div>
            
            <!-- Botão para recolher/expandir sidebar (apenas desktop) -->
            <div class="sidebar-toggle" @click="sidebarOpen = !sidebarOpen" x-show="window.innerWidth > 768">
                <svg :class="{ 'rotate-180': !sidebarOpen }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                </svg>
            </div>
        </aside>
        
        <!-- Conteúdo Principal -->
        <main class="main-content" :class="{ 'collapsed': !sidebarOpen && window.innerWidth > 768 }">
            <!-- Topbar -->
            <div class="topbar">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                
                <div class="flex-between w-full md:justify-end">
                    <h1 class="text-xl font-semibold md:hidden">Dashboard</h1>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Toggle Dark Mode -->
                        <button @click="darkMode = !darkMode; 
                                        darkMode ? localStorage.setItem('theme', 'dark') : localStorage.setItem('theme', 'light')"
                                class="p-2 rounded-lg bg-gray-200 dark:bg-gray-700">
                            <span x-show="!darkMode">🌙</span>
                            <span x-show="darkMode">☀️</span>
                        </button>
                        
                        <!-- User Info -->
                        <div class="flex items-center">
                            <div class="mr-3 text-right hidden md:block">
                                <div class="font-medium">John Doe</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Administrator</div>
                            </div>
                            <div class="user-avatar">JD</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Conteúdo da Página -->
            <div class="page-content">
                <div class="card">
                    <h2 class="card-header">Dashboard</h2>
                    <p>Bem-vindo ao seu painel de administração. Aqui você pode gerenciar todos os aspectos do seu aplicativo.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="card">
                        <h3 class="font-semibold text-lg mb-2">Estatísticas</h3>
                        <p class="text-gray-600 dark:text-gray-300">Visualize as métricas importantes do seu negócio.</p>
                    </div>
                    
                    <div class="card">
                        <h3 class="font-semibold text-lg mb-2">Últimas Atividades</h3>
                        <p class="text-gray-600 dark:text-gray-300">Acompanhe as atividades recentes no sistema.</p>
                    </div>
                    
                    <div class="card">
                        <h3 class="font-semibold text-lg mb-2">Relatórios</h3>
                        <p class="text-gray-600 dark:text-gray-300">Gere relatórios detalhados para análise.</p>
                    </div>
                </div>
                
                <div class="card mt-6">
                    <h3 class="font-semibold text-lg mb-4">Visão Geral do Sistema</h3>
                    <p class="text-gray-600 dark:text-gray-300">Aqui está uma visão geral do status do seu sistema e quaisquer alertas importantes que você precisa conhecer.</p>
                    <div class="mt-4 p-4 bg-green-100 dark:bg-green-900 rounded-lg">
                        <p class="text-green-800 dark:text-green-200">✅ Todos os sistemas estão operando normalmente.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Fechar dropdowns ao clicar fora
        document.addEventListener('click', function(event) {
            const userDropdown = document.querySelector('.user-dropdown');
            const userInfo = document.querySelector('.user-info');
            
            if (userDropdown && userInfo && !userInfo.contains(event.target) && !userDropdown.contains(event.target)) {
                Alpine.$data({ userDropdownOpen: false });
            }
        });
    </script>
</body>
</html>