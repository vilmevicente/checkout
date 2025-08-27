<!-- Sidebar + Content -->
<div 
    x-data="{
        open: true,
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
    class="min-h-screen bg-gray-100 dark:bg-gray-900"
>
    <!-- Toggle (opcional no topo fixo) -->
    <div class="h-[70px] flex items-center px-4 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
            <button @click="open = !open" class="text-gray-600 dark:text-gray-300 hover:opacity-80">
                <!-- Heroicon menu -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        
    <!-- ASIDE (fixo) -->
    <aside
        class="fixed top-[70px] bottom-0 ltr:left-0 rtl:right-0 z-10 border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800 ltr:border-r rtl:border-l print:hidden transition-all duration-300"
        :class="open ? 'w-64' : 'w-20'"
    >
        <!-- Scroll interno -->
        <div class="h-full overflow-y-auto">
            <!-- Título do Menu -->
            <div class="px-5 py-3 text-xs font-medium text-gray-500 cursor-default leading-4 group-data-[sidebar-size=sm]:hidden">
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
                            <!-- Ícone (podes trocar por feather/heroicons à tua escolha) -->
                            <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"/>
                            </svg>
                            <span x-show="open" class="truncate">{{ __('Dashboard') }}</span>
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
                                <span x-show="open" class="truncate">Apps</span>
                            </div>
                            <svg x-show="open" :class="sections.apps ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Submenu Apps -->
                        <ul x-show="sections.apps" x-transition.opacity class="mt-1 space-y-1 pl-3 border-l border-gray-100 dark:border-gray-700">
                            <li>
                                <a href="{{ url('/app-calendar') }}" class="submenu-link">
                                    <span x-show="open">Calendar</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/app-chat') }}" class="submenu-link">
                                    <span x-show="open">Chat</span>
                                </a>
                            </li>

                            <!-- Email -->
                            <li>
                                <button @click="sections.appsEmail = !sections.appsEmail" class="submenu-toggle">
                                    <span x-show="open">Email</span>
                                    <svg x-show="open" :class="sections.appsEmail ? 'rotate-180' : ''" class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <ul x-show="sections.appsEmail" x-transition.opacity class="mt-1 space-y-1 pl-3 border-l border-gray-100 dark:border-gray-700">
                                    <li><a href="{{ url('/apps-email-inbox') }}" class="submenu-link"><span x-show="open">Inbox</span></a></li>
                                    <li><a href="{{ url('/apps-email-read') }}" class="submenu-link"><span x-show="open">Read Email</span></a></li>
                                </ul>
                            </li>

                            <!-- Invoices -->
                            <li>
                                <button @click="sections.appsInvoices = !sections.appsInvoices" class="submenu-toggle">
                                    <span x-show="open">Invoices</span>
                                    <svg x-show="open" :class="sections.appsInvoices ? 'rotate-180' : ''" class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <ul x-show="sections.appsInvoices" x-transition.opacity class="mt-1 space-y-1 pl-3 border-l border-gray-100 dark:border-gray-700">
                                    <li><a href="{{ url('/apps-invoices-list') }}" class="submenu-link"><span x-show="open">Invoice List</span></a></li>
                                    <li><a href="{{ url('/apps-invoices-detail') }}" class="submenu-link"><span x-show="open">Invoice Detail</span></a></li>
                                </ul>
                            </li>

                            <!-- Contacts -->
                            <li>
                                <button @click="sections.appsContacts = !sections.appsContacts" class="submenu-toggle">
                                    <span x-show="open">Contacts</span>
                                    <svg x-show="open" :class="sections.appsContacts ? 'rotate-180' : ''" class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <ul x-show="sections.appsContacts" x-transition.opacity class="mt-1 space-y-1 pl-3 border-l border-gray-100 dark:border-gray-700">
                                    <li><a href="{{ url('/apps-contacts-grid') }}" class="submenu-link"><span x-show="open">User Grid</span></a></li>
                                    <li><a href="{{ url('/apps-contacts-list') }}" class="submenu-link"><span x-show="open">User List</span></a></li>
                                    <li><a href="{{ url('/apps-contacts-profile') }}" class="submenu-link"><span x-show="open">Profile</span></a></li>
                                </ul>
                            </li>

                            <!-- Blog -->
                            <li>
                                <button @click="sections.appsBlog = !sections.appsBlog" class="submenu-toggle">
                                    <span class="flex items-center gap-2" x-show="open">
                                        <span>Blog</span>
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-red-50 text-red-500 dark:bg-red-500/10">New</span>
                                    </span>
                                    <svg x-show="open" :class="sections.appsBlog ? 'rotate-180' : ''" class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <ul x-show="sections.appsBlog" x-transition.opacity class="mt-1 space-y-1 pl-3 border-l border-gray-100 dark:border-gray-700">
                                    <li><a href="{{ url('/apps-blog-grid') }}" class="submenu-link"><span x-show="open">Blog Grid</span></a></li>
                                    <li><a href="{{ url('/apps-blog-list') }}" class="submenu-link"><span x-show="open">Blog List</span></a></li>
                                    <li><a href="{{ url('/apps-blog-detail') }}" class="submenu-link"><span x-show="open">Blog Details</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Authentication -->
                    <li>
                        <button @click="sections.auth = !sections.auth" class="menu-toggle">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 20h5V4H2v16h5m10 0V10M7 20V10m5 10V10"/>
                                </svg>
                                <span x-show="open">Authentication</span>
                            </div>
                            <svg x-show="open" :class="sections.auth ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="sections.auth" x-transition.opacity class="submenu">
                            <li><a href="{{ route('login') }}" class="submenu-link"><span x-show="open">Login</span></a></li>
                            <li><a href="{{ route('register') }}" class="submenu-link"><span x-show="open">Register</span></a></li>
                            <li><a href="{{ url('/recoverpw') }}" class="submenu-link"><span x-show="open">Recover Password</span></a></li>
                            <li><a href="{{ url('/lock-screen') }}" class="submenu-link"><span x-show="open">Lock Screen</span></a></li>
                            <li><a href="{{ route('logout') }}" class="submenu-link"><span x-show="open">Log Out</span></a></li>
                            <li><a href="{{ url('/confirm-mail') }}" class="submenu-link"><span x-show="open">Confirm Mail</span></a></li>
                            <li><a href="{{ url('/email-verification') }}" class="submenu-link"><span x-show="open">Email Verification</span></a></li>
                            <li><a href="{{ url('/two-step-verification') }}" class="submenu-link"><span x-show="open">Two Step Verification</span></a></li>
                        </ul>
                    </li>

                    <!-- Pages -->
                    <li>
                        <button @click="sections.pages = !sections.pages" class="menu-toggle">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 8h10M7 12h8m-8 4h6M5 6h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"/>
                                </svg>
                                <span x-show="open">Pages</span>
                            </div>
                            <svg x-show="open" :class="sections.pages ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="sections.pages" x-transition.opacity class="submenu">
                            <li><a href="{{ url('/starter') }}" class="submenu-link"><span x-show="open">Starter Page</span></a></li>
                            <li><a href="{{ url('/maintenance') }}" class="submenu-link"><span x-show="open">Maintenance</span></a></li>
                            <li><a href="{{ url('/coming-soon') }}" class="submenu-link"><span x-show="open">Coming Soon</span></a></li>
                            <li><a href="{{ url('/timeline') }}" class="submenu-link"><span x-show="open">Timeline</span></a></li>
                            <li><a href="{{ url('/faqs') }}" class="submenu-link"><span x-show="open">FAQs</span></a></li>
                            <li><a href="{{ url('/pricing') }}" class="submenu-link"><span x-show="open">Pricing</span></a></li>
                            <li><a href="{{ url('/404') }}" class="submenu-link"><span x-show="open">Error 404</span></a></li>
                            <li><a href="{{ url('/500') }}" class="submenu-link"><span x-show="open">Error 500</span></a></li>
                        </ul>
                    </li>

                    <!-- Divider + Elements -->
                    <li x-show="open" class="px-5 pt-3 text-xs font-medium text-gray-500 cursor-default leading-4">
                        Elements
                    </li>

                    <!-- Components -->
                    <li>
                        <button @click="sections.components = !sections.components" class="menu-toggle">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9.75 17L8 21l3.75-1.75L15.5 21l-1.75-4 3.75-3.25-4.75-.5L12 9l-1.75 3.25-4.75.5L9.75 17z"/>
                                </svg>
                                <span x-show="open">Components</span>
                            </div>
                            <svg x-show="open" :class="sections.components ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="sections.components" x-transition.opacity class="submenu">
                            <li><a href="{{ url('/alerts') }}" class="submenu-link"><span x-show="open">Alerts</span></a></li>
                            <li><a href="{{ url('/buttons') }}" class="submenu-link"><span x-show="open">Buttons</span></a></li>
                            <li><a href="{{ url('/cards') }}" class="submenu-link"><span x-show="open">Cards</span></a></li>
                            <li><a href="{{ url('/dropdown') }}" class="submenu-link"><span x-show="open">Dropdown</span></a></li>
                            <li><a href="{{ url('/flexbox-grid') }}" class="submenu-link"><span x-show="open">Flexbox & Grid</span></a></li>
                            <li><a href="{{ url('/sizing') }}" class="submenu-link"><span x-show="open">Sizing</span></a></li>
                            <li><a href="{{ url('/avatars') }}" class="submenu-link"><span x-show="open">Avatar</span></a></li>
                            <li><a href="{{ url('/modals') }}" class="submenu-link"><span x-show="open">Modals</span></a></li>
                            <li><a href="{{ url('/progress') }}" class="submenu-link"><span x-show="open">Progress</span></a></li>
                            <li><a href="{{ url('/tabs-accordions') }}" class="submenu-link"><span x-show="open">Tabs & Accordions</span></a></li>
                            <li><a href="{{ url('/typography') }}" class="submenu-link"><span x-show="open">Typography</span></a></li>
                            <li><a href="{{ url('/toasts') }}" class="submenu-link"><span x-show="open">Toasts</span></a></li>
                            <li><a href="{{ url('/general') }}" class="submenu-link"><span x-show="open">General</span></a></li>
                            <li><a href="{{ url('/colors') }}" class="submenu-link"><span x-show="open">Colors</span></a></li>
                            <li><a href="{{ url('/utilities') }}" class="submenu-link"><span x-show="open">Utilities</span></a></li>
                        </ul>
                    </li>

                    <!-- Extended -->
                    <li>
                        <button @click="sections.extended = !sections.extended" class="menu-toggle">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 7h18M3 12h18M3 17h18"/>
                                </svg>
                                <span x-show="open">Extended</span>
                            </div>
                            <svg x-show="open" :class="sections.extended ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="sections.extended" x-transition.opacity class="submenu">
                            <li><a href="{{ url('/extended-lightbox') }}" class="submenu-link"><span x-show="open">Lightbox</span></a></li>
                            <li><a href="{{ url('/extended-rangeslider') }}" class="submenu-link"><span x-show="open">Rangeslider</span></a></li>
                            <li><a href="{{ url('/extended-sweet-alert') }}" class="submenu-link"><span x-show="open">SweetAlert 2</span></a></li>
                            <li><a href="{{ url('/extended-rating') }}" class="submenu-link"><span x-show="open">Rating</span></a></li>
                            <li><a href="{{ url('/extended-notifications') }}" class="submenu-link"><span x-show="open">Notifications</span></a></li>
                        </ul>
                    </li>

                    <!-- Forms -->
                    <li>
                        <button @click="sections.forms = !sections.forms" class="menu-toggle">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3M5 11h14M5 19h14M5 15h14"/>
                                </svg>
                                <span x-show="open">Forms</span>
                            </div>
                            <span x-show="open" class="ml-auto px-2 py-0.5 rounded-full text-[10px] font-medium bg-red-50 text-red-500 dark:bg-red-500/10">7</span>
                            <svg x-show="open" :class="sections.forms ? 'rotate-180' : ''" class="w-4 h-4 transition-transform ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="sections.forms" x-transition.opacity class="submenu">
                            <li><a href="{{ url('/form-elements') }}" class="submenu-link"><span x-show="open">Basic Elements</span></a></li>
                            <li><a href="{{ url('/form-validation') }}" class="submenu-link"><span x-show="open">Validation</span></a></li>
                            <li><a href="{{ url('/form-advanced') }}" class="submenu-link"><span x-show="open">Advanced</span></a></li>
                            <li><a href="{{ url('/form-editors') }}" class="submenu-link"><span x-show="open">Editors</span></a></li>
                            <li><a href="{{ url('/file-uploads') }}" class="submenu-link"><span x-show="open">File Upload</span></a></li>
                            <li><a href="{{ url('/form-wizard') }}" class="submenu-link"><span x-show="open">Wizard</span></a></li>
                            <li><a href="{{ url('/form-mask') }}" class="submenu-link"><span x-show="open">Mask</span></a></li>
                        </ul>
                    </li>

                    <!-- Tables -->
                    <li>
                        <button @click="sections.tables = !sections.tables" class="menu-toggle">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                </svg>
                                <span x-show="open">Tables</span>
                            </div>
                            <svg x-show="open" :class="sections.tables ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="sections.tables" x-transition.opacity class="submenu">
                            <li><a href="{{ url('/tables-basic') }}" class="submenu-link"><span x-show="open">Basic Elements</span></a></li>
                            <li><a href="{{ url('/tables-datatable') }}" class="submenu-link"><span x-show="open">DataTables</span></a></li>
                            <li><a href="{{ url('/tables-responsive') }}" class="submenu-link"><span x-show="open">Responsive</span></a></li>
                            <li><a href="{{ url('/tables-editable') }}" class="submenu-link"><span x-show="open">Editable</span></a></li>
                        </ul>
                    </li>

                    <!-- Charts -->
                    <li>
                        <button @click="sections.charts = !sections.charts" class="menu-toggle">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 19V10m4 9V4M7 19v-6"/>
                                </svg>
                                <span x-show="open">Charts</span>
                            </div>
                            <svg x-show="open" :class="sections.charts ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="sections.charts" x-transition.opacity class="submenu">
                            <li><a href="{{ url('/charts-apex') }}" class="submenu-link"><span x-show="open">Apexcharts</span></a></li>
                            <li><a href="{{ url('/charts-echart') }}" class="submenu-link"><span x-show="open">Echarts</span></a></li>
                            <li><a href="{{ url('/charts-chartjs') }}" class="submenu-link"><span x-show="open">Chartjs</span></a></li>
                            <li><a href="{{ url('/charts-knob') }}" class="submenu-link"><span x-show="open">Jquery Knob</span></a></li>
                            <li><a href="{{ url('/charts-sparkline') }}" class="submenu-link"><span x-show="open">Sparkline Chart</span></a></li>
                        </ul>
                    </li>

                    <!-- Icons -->
                    <li>
                        <button @click="sections.icons = !sections.icons" class="menu-toggle">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4.5l7 4v6.9l-7 4-7-4V8.5l7-4z"/>
                                </svg>
                                <span x-show="open">Icons</span>
                            </div>
                            <svg x-show="open" :class="sections.icons ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="sections.icons" x-transition.opacity class="submenu">
                            <li><a href="{{ url('/icons-boxicons') }}" class="submenu-link"><span x-show="open">Boxicons</span></a></li>
                            <li><a href="{{ url('/icons-materialdesign') }}" class="submenu-link"><span x-show="open">Material Design</span></a></li>
                            <li><a href="{{ url('/icons-dripicons') }}" class="submenu-link"><span x-show="open">Dripicons</span></a></li>
                        </ul>
                    </li>

                    <!-- Maps -->
                    <li>
                        <button @click="sections.maps = !sections.maps" class="menu-toggle">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 20l-5.447-2.724A2 2 0 013 15.382V5.618A2 2 0 014.553 3.894L9 6l6-3 5.447 2.724A2 2 0 0121 5.618v9.764a2 2 0 01-1.553 1.724L15 14l-6 3z"/>
                                </svg>
                                <span x-show="open">Maps</span>
                            </div>
                            <svg x-show="open" :class="sections.maps ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="sections.maps" x-transition.opacity class="submenu">
                            <li><a href="{{ url('/maps-google') }}" class="submenu-link"><span x-show="open">Google</span></a></li>
                            <li><a href="{{ url('/maps-vector') }}" class="submenu-link"><span x-show="open">Vector</span></a></li>
                            <li><a href="{{ url('/maps-leaflet') }}" class="submenu-link"><span x-show="open">Leaflet</span></a></li>
                        </ul>
                    </li>

                    <!-- Multi Level -->
                    <li>
                        <button @click="sections.multi = !sections.multi" class="menu-toggle">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 7h10M7 12h6m-6 5h8"/>
                                </svg>
                                <span x-show="open">Multi Level</span>
                            </div>
                            <svg x-show="open" :class="sections.multi ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <ul x-show="sections.multi" x-transition.opacity class="submenu">
                            <li><a href="{{ url('/') }}" class="submenu-link"><span x-show="open">Level 1.1</span></a></li>
                            <li>
                                <div class="submenu-link !cursor-default">
                                    <span x-show="open">Level 1.2</span>
                                </div>
                                <ul class="mt-1 space-y-1 pl-3 border-l border-gray-100 dark:border-gray-700">
                                    <li><a href="#" class="submenu-link"><span x-show="open">Level 2.1</span></a></li>
                                    <li><a href="#" class="submenu-link"><span x-show="open">Level 2.2</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Alerta/Promo (opcional) -->
                    <li x-show="open" class="mx-4 mt-6">
                        <div class="rounded-xl p-4 bg-violet-50/70 dark:bg-zinc-700/60 text-center">
                            <h5 class="text-sm font-semibold text-violet-600">Unlimited Access</h5>
                            <p class="mt-1 text-xs text-slate-600 dark:text-gray-50">Upgrade your plan from Free to Business.</p>
                            <a href="#!" class="inline-block mt-3 px-3 py-1.5 rounded-md text-white bg-violet-600 hover:bg-violet-700 transition text-sm">Upgrade Now</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="transition-all duration-300"
          :class="open ? 'ltr:ml-64 rtl:mr-64' : 'ltr:ml-20 rtl:mr-20'">
        @yield('content')
    </main>
</div>

<!-- Util classes (Tailwind-first, sem CSS extra) -->
@push('styles')
<style>
/* Usamos utilitários Tailwind; abaixo apenas agrupamos classes via @apply se quiseres extrair para CSS */
</style>
@endpush

@push('scripts')
<script>
    // Se quiseres ativar Feather: feather.replace()
</script>
@endpush
