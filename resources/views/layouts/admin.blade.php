<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin — Portal Perpustakaan SMKN 5 Tangerang')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#0d1117] text-[#e6edf3]">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        @include('components.sidebar-admin')

        {{-- Main Content --}}
        <div class="flex-1 ml-0 lg:ml-[260px]">
            {{-- Topbar --}}
            <header class="sticky top-0 z-30 bg-[#0d1117]/80 backdrop-blur-xl border-b border-[#30363d]">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center gap-3">
                        {{-- Mobile menu toggle --}}
                        <button onclick="document.getElementById('admin-sidebar').classList.toggle('-translate-x-full')" class="lg:hidden text-[#8b949e] hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <nav class="text-sm text-[#8b949e]">
                            <span class="text-blue-400">Admin</span>
                            <span class="mx-2">/</span>
                            <span class="text-[#e6edf3]">@yield('breadcrumb', 'Dashboard')</span>
                        </nav>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-[#8b949e] hidden sm:block">{{ Auth::user()->name }}</span>
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-violet-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="p-6">
                @include('components.toast')
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
