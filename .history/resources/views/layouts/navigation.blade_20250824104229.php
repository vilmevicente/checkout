<!-- Sidebar -->
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
            <!-- Aqui manténs os teus <ul> e <li> -->
            {{--- menus que já tinhas ---}}
        </nav>
    </div>
</aside>
