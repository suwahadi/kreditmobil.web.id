<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Harga Mobil Daihatsu di Astra Daihatsu dealer Resmi, Cek Promo & Diskon 2026">
    <meta name="keywords" content="daihatsu, mobil daihatsu, harga mobil daihatsu, dealer daihatsu">
    
    <title>@yield('title', 'Daftar Harga Mobil Daihatsu - ' . env('APP_NAME'))</title>

    <!-- Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
            :root,:host{--font-sans:'Poppins';--font-serif:'Poppins';}
            *{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}
            body{font-family:'Poppins';line-height:inherit}
            html{scroll-behavior:smooth}
        </style>
    @endif
    
    <!-- Livewire Styles -->
    @livewireStyles
    <style>
        html{scroll-behavior:smooth}
        body{font-family:'Poppins', sans-serif !important}
        *{font-family:'Poppins', sans-serif !important}
        h1,h2,h3,h4,h5,h6{font-family:'Poppins', sans-serif !important}
        p,span,div,li,td,th,a{font-family:'Poppins', sans-serif !important}
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <img 
                            src="https://medias.astra-daihatsu.id/sys-master-media/h70/hc8/8819719208990/astraDaihatsulogo.svg" 
                            alt="Astra Daihatsu" 
                            class="h-8 md:h-9 w-auto"
                            onerror="this.style.display='none'"
                            loading="lazy"
                        >
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-red-600 font-medium transition-colors">
                        Beranda
                    </a>
                    <a href="{{ route('promo.index') }}" class="text-gray-700 hover:text-red-600 font-medium transition-colors">
                        Promo
                    </a>
                    <a href="{{ route('news.index') }}" class="text-gray-700 hover:text-red-600 font-medium transition-colors">
                        Artikel / Berita
                    </a>
                    <a href="#" class="text-gray-700 hover:text-red-600 font-medium transition-colors">
                        Hubungi Kami
                    </a>
                </nav>

                <!-- Mobile menu button -->
                <button class="md:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-200">
            <div class="max-w-6xl mx-auto px-4 py-2 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Beranda</a>
                <a href="{{ route('promo.index') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Promo</a>
                <a href="{{ route('news.index') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Artikel / Berita</a>
                <a href="#" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Hubungi Kami</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-6xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold">D</span>
                        </div>
                        <span class="text-lg font-bold">Astra Daihatsu</span>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Dealer resmi mobil Daihatsu dengan harga terbaik dan pelayanan terpercaya.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-semibold mb-4">Produk</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/mobil/all-new-ayla" class="text-gray-400 hover:text-white">All New Ayla</a></li>
                        <li><a href="/mobil/granmax-pick-up" class="text-gray-400 hover:text-white">GranMax Pick Up</a></li>
                        <li><a href="/mobil/new-terios" class="text-gray-400 hover:text-white">New Terios</a></li>
                        <li><a href="/mobil/all-new-xenia" class="text-gray-400 hover:text-white">All New Xenia</a></li>
                        <li><a href="/mobil/new-sigra" class="text-gray-400 hover:text-white">New Sigra</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="font-semibold mb-4">Navigasi</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Beranda</a></li>
                        <li><a href="{{ route('promo.index') }}" class="text-gray-400 hover:text-white">Promo</a></li>
                        <li><a href="{{ route('news.index') }}" class="text-gray-400 hover:text-white">Artikel / Berita</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Sales Executive</li>
                        <li>082266603388</li>
                        <li>sales@kreditmobil.web.id</li>
                        <li>https://kreditmobil.web.id</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; 2026 {{ env('APP_NAME') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Custom Scripts -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        document.addEventListener('click', function(event) {
            const menu = document.getElementById('mobileMenu');
            const menuButton = event.target.closest('button');
            
            if (!menu.contains(event.target) && !menuButton) {
                menu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
