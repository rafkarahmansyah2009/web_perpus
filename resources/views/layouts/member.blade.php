<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Member — Portal Perpustakaan SMKN 5 Tangerang')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#0d1117] text-[#e6edf3]">
    {{-- Navbar --}}
    <nav class="sticky top-0 z-50 bg-[#161b22] border-b border-[#30363d]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-8">
                    <a href="/member/dashboard" class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-violet-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <span class="font-bold font-['Space_Grotesk'] hidden sm:block">Perpustakaan</span>
                    </a>
                    <div class="hidden md:flex items-center gap-1">
                        <a href="/" class="px-3 py-2 rounded-lg text-sm text-[#8b949e] hover:text-white hover:bg-[#1c2128] transition-all">Beranda</a>
                        <a href="/katalog" class="px-3 py-2 rounded-lg text-sm text-[#8b949e] hover:text-white hover:bg-[#1c2128] transition-all">Katalog</a>
                        <a href="/member/pinjaman" class="px-3 py-2 rounded-lg text-sm {{ request()->is('member/pinjaman*') ? 'text-blue-400 bg-blue-500/10' : 'text-[#8b949e] hover:text-white hover:bg-[#1c2128]' }} transition-all">Pinjaman Saya</a>
                    </div>
                </div>
                <div class="relative" x-data="{ open: false }">
                    <button onclick="this.nextElementSibling.classList.toggle('hidden')" class="flex items-center gap-3 hover:bg-[#1c2128] px-3 py-2 rounded-xl transition-all">
                        @if(Auth::user()->foto)
                            <img src="{{ asset('storage/' . Auth::user()->foto) }}" class="w-8 h-8 rounded-full object-cover">
                        @else
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-violet-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <span class="text-sm hidden sm:block">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-[#8b949e]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="hidden absolute right-0 mt-2 w-48 bg-[#161b22] border border-[#30363d] rounded-xl shadow-xl overflow-hidden z-50">
                        <a href="/member/profil" class="block px-4 py-3 text-sm text-[#8b949e] hover:text-white hover:bg-[#1c2128] transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Profil
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-400 hover:text-red-300 hover:bg-[#1c2128] transition-colors">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-8">
        @include('components.toast')
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
