<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - Acrevis Bank</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 antialiased">
    @php
        $currentLocale = app()->getLocale();
    @endphp

    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: true, mobileMenuOpen: false }">
        <!-- Sidebar Desktop -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="hidden lg:flex lg:flex-col lg:fixed lg:inset-y-0 transition-all duration-300 bg-slate-900 text-white shadow-2xl z-20 border-r border-slate-800">
            <!-- Logo Section -->
            <div class="flex items-center justify-between px-4 py-5 border-b border-slate-800">
                <a href="{{ route('dashboard.index', ['locale' => $currentLocale]) }}" class="flex items-center" :class="!sidebarOpen && 'justify-center w-full'">
                    <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                        </svg>
                    </div>
                    <span x-show="sidebarOpen" class="ml-3 text-lg font-semibold tracking-tight">Acrevis Bank</span>
                </a>
                <button @click="sidebarOpen = !sidebarOpen" class="p-1.5 rounded-md hover:bg-slate-800 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                </button>
            </div>

            <!-- User Info -->
            <div class="px-4 py-4 border-b border-slate-800" x-show="sidebarOpen">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-sm font-semibold">
                        {{ strtoupper(substr(Auth::user()->first_name ?? Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="ml-3 overflow-hidden flex-1">
                        <p class="text-sm font-medium truncate">{{ Auth::user()->first_name ?? Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                @php
                    $currentRoute = request()->route()->getName();

                    $menuItems = [
                        [
                            'route' => 'dashboard.index',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
                            'label' => 'Tableau de bord',
                            'active' => $currentRoute === 'dashboard.index'
                        ],
                        [
                            'route' => 'dashboard.transfer',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>',
                            'label' => 'Nouveau virement',
                            'active' => $currentRoute === 'dashboard.transfer'
                        ],
                        [
                            'route' => 'dashboard.beneficiaries.index',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
                            'label' => 'Bénéficiaires',
                            'active' => str_contains($currentRoute, 'beneficiaries')
                        ],
                        [
                            'route' => 'dashboard.credit-requests.index',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                            'label' => 'Mes demandes de prêt',
                            'active' => str_contains($currentRoute ?? '', 'credit-requests')
                        ],
                    ];
                @endphp

                @foreach($menuItems as $item)
                    <a href="{{ route($item['route'], ['locale' => $currentLocale]) }}"
                       class="flex items-center px-3 py-2.5 rounded-lg transition-colors duration-150 group
                              {{ $item['active']
                                  ? 'bg-blue-600 text-white'
                                  : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                       :class="!sidebarOpen && 'justify-center'">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $item['icon'] !!}
                        </svg>
                        <span x-show="sidebarOpen" class="ml-3 text-sm font-medium whitespace-nowrap">{{ $item['label'] }}</span>
                    </a>
                @endforeach

                <div class="border-t border-slate-800 my-3"></div>

                <!-- Settings & Logout -->
                <a href="{{ route('home', ['locale' => $currentLocale]) }}"
                   class="flex items-center px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-colors duration-150"
                   :class="!sidebarOpen && 'justify-center'">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Accueil site</span>
                </a>

                <form method="POST" action="{{ route('logout', ['locale' => $currentLocale]) }}">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center px-3 py-2.5 rounded-lg text-slate-300 hover:bg-red-900/30 hover:text-white transition-colors duration-150"
                            :class="!sidebarOpen && 'justify-center'">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Déconnexion</span>
                    </button>
                </form>
            </nav>

            <!-- Security Badge -->
            <div class="px-4 py-3 border-t border-slate-800" x-show="sidebarOpen">
                <div class="flex items-center text-xs text-slate-400">
                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Connexion sécurisée</span>
                </div>
            </div>
        </aside>

        <!-- Mobile Menu Button -->
        <div class="lg:hidden fixed top-0 left-0 right-0 z-30 bg-slate-900 text-white px-4 py-3 flex items-center justify-between shadow-lg border-b border-slate-800">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                    </svg>
                </div>
                <span class="text-lg font-semibold">Acrevis Bank</span>
            </div>
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-md hover:bg-slate-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu Overlay -->
        <div x-show="mobileMenuOpen"
             @click="mobileMenuOpen = false"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="lg:hidden fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm"
             style="display: none;">
        </div>

        <!-- Mobile Menu -->
        <aside x-show="mobileMenuOpen"
               x-transition:enter="transition ease-in-out duration-300 transform"
               x-transition:enter-start="-translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition ease-in-out duration-300 transform"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="-translate-x-full"
               class="lg:hidden fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white shadow-2xl overflow-y-auto border-r border-slate-800"
               style="display: none;">
            <div class="px-4 py-6">
                <div class="flex items-center justify-between mb-6">
                    <span class="text-lg font-semibold">Menu</span>
                    <button @click="mobileMenuOpen = false" class="p-2 rounded-md hover:bg-slate-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <nav class="space-y-1">
                    @foreach($menuItems as $item)
                        <a href="{{ route($item['route'], ['locale' => $currentLocale]) }}"
                           class="flex items-center px-3 py-2.5 rounded-lg transition-colors
                                  {{ $item['active'] ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $item['icon'] !!}
                            </svg>
                            <span class="ml-3 text-sm">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'" class="flex-1 flex flex-col min-h-screen transition-all duration-300 overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-slate-200 sticky top-0 z-10 lg:mt-0 mt-14">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-slate-900">{{ $pageTitle ?? 'Dashboard' }}</h1>
                            @if(isset($pageSubtitle))
                                <p class="text-sm text-slate-600 mt-1">{{ $pageSubtitle }}</p>
                            @endif
                        </div>
                        <div class="flex items-center space-x-4">
                            <!-- Quick Balance Display -->
                            @if(isset($showBalance) && $showBalance)
                                <div class="hidden md:block text-right">
                                    <p class="text-xs text-slate-500 font-medium">Solde total</p>
                                    <p class="text-lg font-bold text-slate-900">{{ $totalBalance ?? '0.00' }} CHF</p>
                                </div>
                            @endif

                            <!-- Notifications -->
                            <button class="p-2 rounded-lg hover:bg-slate-100 relative transition-colors">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-slate-50">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-slate-200 py-4 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between text-xs text-slate-500">
                    <p>&copy; {{ date('Y') }} Acrevis Bank. Tous droits réservés.</p>
                    <div class="flex items-center space-x-4">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Réglementé FINMA
                        </span>
                        <span class="hidden sm:inline">|</span>
                        <span class="hidden sm:inline">Protection des données LPD/RGPD</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
