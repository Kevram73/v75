<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('/images/V75.png')}}" style="border-radius: 100%;">
    <title>@yield('title', 'V75 Pro Admin')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts - Monospace for engineering style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', 'JetBrains Mono', monospace;
        }
        body {
            font-size: 13px;
        }
        code, .mono {
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
        }
        @media (max-width: 768px) {
            .sidebar-mobile {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            .sidebar-mobile.open {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile Menu Button -->
        <button id="mobileMenuBtn" class="md:hidden fixed top-4 left-4 z-50 bg-gray-800 text-white p-2 rounded-md">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Mobile Overlay -->
        <div id="mobileOverlay" class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
        
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed md:static w-56 bg-gray-800 border-r-2 border-gray-900 flex flex-col h-full z-40 sidebar-mobile md:translate-x-0">
            <!-- Logo -->
            <div class="px-4 py-3 border-b-2 border-gray-900">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gray-900 border border-gray-700 flex items-center justify-center rounded-full overflow-hidden">
                        <img src="{{asset('/images/V75.png')}}" alt="V75" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h1 class="text-sm font-bold text-gray-100 uppercase tracking-tight">V75 Pro</h1>
                        <p class="text-xs text-gray-400 font-mono">ADMIN</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="flex-1 px-2 py-2 space-y-0.5 overflow-y-auto">
                <a href="{{ route('admin.home') }}" class="flex items-center px-3 py-2 text-xs font-medium {{ request()->routeIs('admin.home') ? 'bg-gray-900 text-white border-l-2 border-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-home w-4 mr-2"></i>
                    <span>DASHBOARD</span>
                </a>
                
                <a href="{{ route('admin.clients.index') }}" class="flex items-center px-3 py-2 text-xs font-medium {{ request()->routeIs('admin.clients.*') ? 'bg-gray-900 text-white border-l-2 border-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-users w-4 mr-2"></i>
                    <span>CLIENTS</span>
                </a>
                
                <a href="{{ route('admin.clients.disabled') }}" class="flex items-center px-3 py-2 text-xs font-medium {{ request()->routeIs('admin.clients.disabled') ? 'bg-gray-900 text-white border-l-2 border-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-user-slash w-4 mr-2"></i>
                    <span>CLIENTS DÉSACTIVÉS</span>
                </a>
                
                <a href="{{ route('admin.deposits') }}" class="flex items-center px-3 py-2 text-xs font-medium {{ request()->routeIs('admin.deposits') ? 'bg-gray-900 text-white border-l-2 border-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-arrow-down w-4 mr-2"></i>
                    <span>DÉPÔTS</span>
                </a>
                
                <a href="{{ route('admin.withdrawals') }}" class="flex items-center px-3 py-2 text-xs font-medium {{ request()->routeIs('admin.withdrawals') ? 'bg-gray-900 text-white border-l-2 border-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-arrow-up w-4 mr-2"></i>
                    <span>RETRAITS</span>
                </a>
                
                <a href="{{ route('admin.transactions.index') }}" class="flex items-center px-3 py-2 text-xs font-medium {{ request()->routeIs('admin.transactions*') ? 'bg-gray-900 text-white border-l-2 border-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-exchange-alt w-4 mr-2"></i>
                    <span>TRANSACTIONS</span>
                </a>
                
                @php
                    $unreadMessagesCount = \App\Models\Message::where(function($query) {
                            $query->whereNotNull('client_id')->orWhereNotNull('sender_id');
                        })
                        ->whereNull('response')
                        ->whereNull('deleted_at')
                        ->count();
                @endphp
                <a href="{{ route('admin.messages.index') }}" class="flex items-center px-3 py-2 text-xs font-medium {{ request()->routeIs('admin.messages*') ? 'bg-gray-900 text-white border-l-2 border-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-envelope w-4 mr-2"></i>
                    <span>MESSAGES</span>
                    @if($unreadMessagesCount > 0)
                        <span class="ml-auto bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>
                
                <a href="{{ route('admin.stats') }}" class="flex items-center px-3 py-2 text-xs font-medium {{ request()->routeIs('admin.stats') ? 'bg-gray-900 text-white border-l-2 border-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-chart-pie w-4 mr-2"></i>
                    <span>STATISTIQUES</span>
                </a>
                
                <a href="{{ route('admin.profile') }}" class="flex items-center px-3 py-2 text-xs font-medium {{ request()->routeIs('admin.profile') ? 'bg-gray-900 text-white border-l-2 border-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-user-cog w-4 mr-2"></i>
                    <span>PROFIL</span>
                </a>
                
                <a href="{{ route('admin.accounts.index') }}" class="flex items-center px-3 py-2 text-xs font-medium {{ request()->routeIs('admin.accounts.*') ? 'bg-gray-900 text-white border-l-2 border-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-wallet w-4 mr-2"></i>
                    <span>COMPTES</span>
                </a>
                
                <a href="{{ route('admin.admins.index') }}" class="flex items-center px-3 py-2 text-xs font-medium {{ request()->routeIs('admin.admins.*') ? 'bg-gray-900 text-white border-l-2 border-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-user-shield w-4 mr-2"></i>
                    <span>ADMINS</span>
                </a>
            </nav>
            
            <!-- Footer -->
            <div class="p-2 border-t-2 border-gray-900">
                <form action="{{ route('admin.auth_logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-3 py-2 text-xs font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-sign-out-alt w-4 mr-2"></i>
                        <span>LOGOUT</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden bg-white md:ml-0">
            <!-- Header -->
            <header class="bg-white border-b-2 border-gray-300">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between px-4 md:px-6 py-3">
                    <div class="mb-2 md:mb-0">
                        <h2 class="text-sm md:text-base font-bold text-gray-900 uppercase tracking-tight">@yield('page-title', 'DASHBOARD')</h2>
                        <p class="text-xs text-gray-500 font-mono mt-0.5">@yield('page-subtitle', 'OVERVIEW')</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-semibold text-gray-900">{{ Auth::guard('admin')->user()->name ?? 'ADMIN' }}</p>
                            <p class="text-xs text-gray-500 font-mono">{{ Auth::guard('admin')->user()->email ?? '' }}</p>
                        </div>
                        <div class="w-8 h-8 bg-gray-800 border-2 border-gray-900 flex items-center justify-center text-white text-xs font-bold">
                            {{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'A', 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
                <!-- Alerts -->
                @if(session('success'))
                    <div class="mb-4 bg-gray-100 border-l-4 border-gray-600 p-3 border border-gray-300">
                        <div class="flex items-center">
                            <span class="text-gray-600 mr-2 font-mono">[OK]</span>
                            <p class="text-xs font-medium text-gray-900">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-gray-100 border-l-4 border-gray-800 p-3 border border-gray-300">
                        <div class="flex items-center">
                            <span class="text-gray-800 mr-2 font-mono">[ERR]</span>
                            <p class="text-xs font-medium text-gray-900">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 bg-gray-100 border-l-4 border-gray-800 p-3 border border-gray-300">
                        <div class="flex items-start">
                            <span class="text-gray-800 mr-2 font-mono">[ERR]</span>
                            <div>
                                <p class="text-xs font-medium text-gray-900 mb-1">Erreurs de validation:</p>
                                <ul class="list-disc list-inside text-xs text-gray-700">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="{{asset('/src/js/vendors.min.js')}}"></script>
    <script src="{{asset('/assets/icons/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('/src/js/template.js')}}"></script>
    
    @stack('datatable')
    @stack('editor')
    @stack('profile')
    @stack('home')
    
    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');
        
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', function() {
                sidebar.classList.toggle('open');
                mobileOverlay.classList.toggle('hidden');
            });
        }
        
        if (mobileOverlay) {
            mobileOverlay.addEventListener('click', function() {
                sidebar.classList.remove('open');
                mobileOverlay.classList.add('hidden');
            });
        }
        
        // Close menu when clicking on a link (mobile)
        const navLinks = document.querySelectorAll('#sidebar nav a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    sidebar.classList.remove('open');
                    mobileOverlay.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>

