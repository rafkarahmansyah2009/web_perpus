<nav id="main-navbar" class="fixed top-0 left-0 right-0 z-50 bg-transparent transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16">
            <a href="/" class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-violet-500 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <span class="text-lg font-bold font-['Space_Grotesk'] text-white">Perpustakaan <span class="text-blue-400">SMKN 5</span></span>
            </a>

            <div class="hidden md:flex items-center gap-1">
                <a href="/" class="px-4 py-2 rounded-xl text-sm transition-all {{ request()->is('/') ? 'text-white bg-white/10' : 'text-[#8b949e] hover:text-white hover:bg-white/5' }}">Beranda</a>
                <a href="/katalog" class="px-4 py-2 rounded-xl text-sm transition-all {{ request()->is('katalog*') ? 'text-white bg-white/10' : 'text-[#8b949e] hover:text-white hover:bg-white/5' }}">Katalog</a>
                <a href="/pengumuman" class="px-4 py-2 rounded-xl text-sm transition-all {{ request()->is('pengumuman*') ? 'text-white bg-white/10' : 'text-[#8b949e] hover:text-white hover:bg-white/5' }}">Pengumuman</a>
            </div>

            <div class="flex items-center gap-3">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="/admin/dashboard" class="btn-gradient text-sm">Dashboard</a>
                    @else
                        <a href="/member/dashboard" class="btn-gradient text-sm">Dashboard</a>
                    @endif
                @else
                    <a href="/login" class="btn-gradient text-sm">Masuk</a>
                @endauth
                <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="md:hidden text-[#8b949e] hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div id="mobile-menu" class="hidden md:hidden pb-4">
            <div class="flex flex-col gap-1">
                <a href="/" class="px-4 py-3 rounded-xl text-sm text-[#8b949e] hover:text-white hover:bg-white/5 transition-all">Beranda</a>
                <a href="/katalog" class="px-4 py-3 rounded-xl text-sm text-[#8b949e] hover:text-white hover:bg-white/5 transition-all">Katalog</a>
                <a href="/pengumuman" class="px-4 py-3 rounded-xl text-sm text-[#8b949e] hover:text-white hover:bg-white/5 transition-all">Pengumuman</a>
            </div>
        </div>
    </div>
</nav>
