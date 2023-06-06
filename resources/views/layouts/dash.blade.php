<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta')

    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <livewire:styles />
    @stack('style')
</head>

<body class="h-full overflow-hidden">
    <div class="h-full flex">
        <!-- Sidebar menu -->
        @include('layouts._navbar')

        <!-- Content area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="w-full">
                <div class="relative z-10 flex-shrink-0 h-16 bg-white border-b border-gray-200 shadow-sm flex">
                    <button x-data x-on:click="$dispatch('opensidenav', {id: 1})" type="button"
                        class="border-r border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <!-- Heroicon name: outline/menu-alt-2 -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </button>
                    <div class="flex-1 flex justify-between px-4 sm:px-6">
                        <div class="flex-1 flex">
                            <form class="w-full flex md:ml-0" action="#" method="GET">
                                <label for="desktop-search-field" class="sr-only">Search all files</label>
                                <label for="mobile-search-field" class="sr-only">Search all files</label>
                                <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center">
                                        <!-- Heroicon name: solid/search -->
                                        <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input name="mobile-search-field" id="mobile-search-field"
                                        class="h-full w-full border-transparent py-2 pl-8 pr-3 text-base text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent focus:placeholder-gray-400 sm:hidden"
                                        placeholder="Search" type="search">
                                    <input name="desktop-search-field" id="desktop-search-field"
                                        class="hidden h-full w-full border-transparent py-2 pl-8 pr-3 text-base text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent focus:placeholder-gray-400 sm:block"
                                        placeholder="Search all files" type="search">
                                </div>
                            </form>
                        </div>
                        <div class="ml-2 flex items-center space-x-4 sm:ml-6 sm:space-x-6">
                            <!-- Profile dropdown -->
                            <div x-data="{ open: false }" class="relative flex-shrink-0">
                                <div>
                                    <button x-on:click="open = !open" type="button"
                                        class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full" src="{{ asset('images/admin.png') }}"
                                            alt="Avatar">
                                    </button>
                                </div>

                                <!-- Dropdown menu, show/hide based on menu state. -->
                                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1" x-cloak>
                                    <!-- Active: "bg-gray-100", Not Active: "" -->

                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();"
                                        class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">Log
                                        out</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content -->
            <div class="flex-1 flex items-stretch overflow-hidden">
                <main class="flex-1 overflow-y-auto lg:order-last">
                    {{ $slot }}
                </main>
                <!-- Secondary column (hidden on smaller screens) -->
                <aside x-data="{ secondary: false }" x-show="secondary"
                    @opensecondary.window="if ($event.detail.id == 1) secondary = true" @click.away="secondary = false"
                    x-cloak class="hidden lg:order-first lg:block lg:flex-shrink-0">
                    <div class="relative flex h-full w-64 flex-col overflow-y-auto border-r border-gray-200 bg-white">
                        <div class="flex h-16 flex-shrink-0 items-center px-6">
                            <p class="text-lg font-medium text-blue-gray-900">More options</p>
                        </div>
                        <nav class="space-y-1">
                            <a href="{{ route('dash.views', 'info') }}"
                                class="{{ request()->item == 'info' ? 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900' }} group border-l-4 px-6 py-2 flex items-center text-sm font-medium"
                                aria-current="page">
                                <x-icon.o-information-circle
                                    class="{{ request()->item == 'info' ? 'text-blue-500 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }} flex-shrink-0 -ml-1 mr-3 h-6 w-6" />
                                <span class="truncate">Info penting</span>
                            </a>

                            <a href="{{ route('dash.views', 'achievements') }}"
                                class="{{ request()->item == 'achievements' ? 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900' }} group border-l-4 px-6 py-2 flex items-center text-sm font-medium">
                                <x-icon.o-trophy
                                    class="{{ request()->item == 'achievements' ? 'text-blue-500 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }} flex-shrink-0 -ml-1 mr-3 h-6 w-6" />
                                <span class="truncate">Prestasi</span>
                            </a>

                            <a href="{{ route('dash.views', 'alumni') }}"
                            class="{{ in_array(request()->item, ['alumni', 'alumni-show']) ? 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900' }} group border-l-4 px-6 py-2 flex items-center text-sm font-medium">
                                <x-icon.o-user-group class="{{ in_array(request()->item, ['alumni', 'alumni-show']) ? 'text-blue-500 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }} flex-shrink-0 -ml-1 mr-3 h-6 w-6" />
                                <span class="truncate">Sebaran alumni</span>
                            </a>


                            <a href="{{ route('dash.views', 'testimonial') }}"
                                class="{{ request()->item == 'testimonial' ? 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900' }} group border-l-4 px-6 py-2 flex items-center text-sm font-medium">
                                <x-icon.o-megaphone
                                    class="{{ request()->item == 'testimonial' ? 'text-blue-500 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }} flex-shrink-0 -ml-1 mr-3 h-6 w-6" />
                                <span class="truncate">Testimonial</span>
                            </a>

                            <a href="{{ route('dash.views', 'menu') }}"
                                class="{{ request()->item == 'menu' ? 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900' }} group border-l-4 px-6 py-2 flex items-center text-sm font-medium">
                                <x-icon.o-adjustments-horizontal
                                    class="{{ request()->item == 'menu' ? 'text-blue-500 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }} flex-shrink-0 -ml-1 mr-3 h-6 w-6" />
                                <span class="truncate">Menu</span>
                            </a>

                            <a href="{{ route('dash.views', 'settings') }}"
                                class="{{ request()->item == 'settings' ? 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900' }} group border-l-4 px-6 py-2 flex items-center text-sm font-medium">
                                <x-icon.o-cog-8
                                    class="{{ request()->item == 'settings' ? 'text-blue-500 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }} flex-shrink-0 -ml-1 mr-3 h-6 w-6" />
                                <span class="truncate">Setting</span>
                            </a>
                        </nav>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    @livewire('livewire-ui-modal')

    <livewire:scripts />
    <x-notification />

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                button: false,
            });
        });

        window.addEventListener('swal:confirm', event => {
            swal({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.livewire.emit(event.detail.method, event.detail.id);
                    }
                });
        });
    </script>
    @stack('script')
</body>

</html>
