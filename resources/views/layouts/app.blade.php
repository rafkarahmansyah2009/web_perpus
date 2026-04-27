<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal Perpustakaan Digital SMKN 5 Tangerang — Akses katalog buku, peminjaman online, dan informasi perpustakaan.">
    <title>@yield('title', 'Portal Perpustakaan SMKN 5 Tangerang')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#0d1117] text-[#e6edf3]">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Toast --}}
    @include('components.toast')

    {{-- Footer --}}
    <footer class="bg-[#161b22] border-t border-[#30363d] mt-20">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-violet-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg font-['Space_Grotesk']">Perpustakaan SMKN 5</h3>
                            <p class="text-xs text-[#8b949e]">Tangerang</p>
                        </div>
                    </div>
                    <p class="text-[#8b949e] text-sm leading-relaxed">Portal Perpustakaan Digital SMKN 5 Tangerang untuk kemudahan akses koleksi buku dan layanan perpustakaan.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 font-['Space_Grotesk']">Navigasi</h4>
                    <ul class="space-y-2 text-[#8b949e] text-sm">
                        <li><a href="/" class="hover:text-blue-400 transition-colors">Beranda</a></li>
                        <li><a href="/katalog" class="hover:text-blue-400 transition-colors">Katalog Buku</a></li>
                        <li><a href="/pengumuman" class="hover:text-blue-400 transition-colors">Pengumuman</a></li>
                        <li><a href="/login" class="hover:text-blue-400 transition-colors">Masuk</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4 font-['Space_Grotesk']">Jam Operasional</h4>
                    <ul class="space-y-2 text-[#8b949e] text-sm">
                        <li class="flex justify-between"><span>Senin - Kamis</span><span>07.00 - 15.00</span></li>
                        <li class="flex justify-between"><span>Jumat</span><span>07.00 - 11.30</span></li>
                        <li class="flex justify-between"><span>Sabtu - Minggu</span><span class="text-red-400">Tutup</span></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-[#30363d] mt-8 pt-8 text-center text-[#8b949e] text-sm">
                &copy; {{ date('Y') }} Perpustakaan SMKN 5 Tangerang. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('main-navbar');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('bg-[#0d1117]/95', 'backdrop-blur-xl', 'shadow-lg', 'shadow-black/20');
                    navbar.classList.remove('bg-transparent');
                } else {
                    navbar.classList.remove('bg-[#0d1117]/95', 'backdrop-blur-xl', 'shadow-lg', 'shadow-black/20');
                    navbar.classList.add('bg-transparent');
                }
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
