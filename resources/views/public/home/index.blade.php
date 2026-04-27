@extends('layouts.app')
@section('title', 'Portal Perpustakaan SMKN 5 Tangerang')

@section('content')
{{-- Hero Section --}}
<section class="min-h-screen flex items-center justify-center relative overflow-hidden pt-16">
    {{-- Background effects --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-20 right-20 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 left-20 w-96 h-96 bg-violet-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-500/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative z-10 text-center px-6 max-w-4xl mx-auto animate-fade-in-up">
        <div class="inline-flex items-center gap-2 bg-blue-500/10 border border-blue-500/20 rounded-full px-4 py-2 mb-8">
            <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
            <span class="text-blue-400 text-sm font-medium">Portal Perpustakaan Digital</span>
        </div>

        <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold font-['Space_Grotesk'] mb-6 leading-tight">
            Eksplorasi Ribuan<br>
            <span class="bg-gradient-to-r from-blue-400 via-blue-500 to-violet-500 bg-clip-text text-transparent">Koleksi Buku Digital</span>
        </h1>

        <p class="text-lg md:text-xl text-[#8b949e] max-w-2xl mx-auto mb-10 leading-relaxed">
            Akses katalog perpustakaan SMKN 5 Tangerang secara online. Cari, pinjam, dan kelola buku favoritmu dengan mudah.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/katalog" class="btn-gradient px-8 py-3.5 text-base flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Jelajahi Katalog
            </a>
            <a href="/login" class="px-8 py-3.5 text-base border border-[#30363d] rounded-xl text-[#e6edf3] hover:bg-[#161b22] hover:border-[#484f58] transition-all duration-300 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                Masuk
            </a>
        </div>
    </div>
</section>

{{-- Stats Section --}}
<section class="py-16 relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="card-dark p-6 text-center group hover:border-blue-500/30 transition-all duration-300">
                <div class="w-14 h-14 bg-blue-500/10 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-500/20 transition-colors">
                    <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 class="text-3xl font-bold font-['Space_Grotesk'] text-blue-400 mb-1">{{ number_format($totalBooks) }}</h3>
                <p class="text-[#8b949e] text-sm">Total Koleksi Buku</p>
            </div>
            <div class="card-dark p-6 text-center group hover:border-violet-500/30 transition-all duration-300">
                <div class="w-14 h-14 bg-violet-500/10 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-violet-500/20 transition-colors">
                    <svg class="w-7 h-7 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h3 class="text-3xl font-bold font-['Space_Grotesk'] text-violet-400 mb-1">{{ number_format($totalMembers) }}</h3>
                <p class="text-[#8b949e] text-sm">Anggota Aktif</p>
            </div>
            <div class="card-dark p-6 text-center group hover:border-green-500/30 transition-all duration-300">
                <div class="w-14 h-14 bg-green-500/10 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-green-500/20 transition-colors">
                    <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h3 class="text-3xl font-bold font-['Space_Grotesk'] text-green-400 mb-1">{{ number_format($availableToday) }}</h3>
                <p class="text-[#8b949e] text-sm">Tersedia Hari Ini</p>
            </div>
        </div>
    </div>
</section>

{{-- Latest Books --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold font-['Space_Grotesk']">Buku Terbaru</h2>
                <p class="text-[#8b949e] mt-1">Koleksi terbaru di perpustakaan kami</p>
            </div>
            <a href="/katalog" class="text-blue-400 hover:text-blue-300 text-sm font-medium flex items-center gap-1 transition-colors">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($latestBooks as $book)
                @include('components.book-card', ['book' => $book])
            @endforeach
        </div>
    </div>
</section>

{{-- Announcements --}}
@if($announcements->count())
<section class="py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold font-['Space_Grotesk']">Pengumuman Terbaru</h2>
                <p class="text-[#8b949e] mt-1">Informasi penting dari perpustakaan</p>
            </div>
            <a href="/pengumuman" class="text-blue-400 hover:text-blue-300 text-sm font-medium flex items-center gap-1 transition-colors">
                Semua Pengumuman
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($announcements as $ann)
                <a href="/pengumuman/{{ $ann->slug }}" class="card-dark p-6 group hover:border-blue-500/30 transition-all duration-300">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="badge-pill bg-blue-500/10 text-blue-400 border border-blue-500/20">Pengumuman</span>
                        <span class="text-xs text-[#8b949e]">{{ $ann->tgl_publish?->format('d M Y') }}</span>
                    </div>
                    <h3 class="font-semibold font-['Space_Grotesk'] mb-2 group-hover:text-blue-400 transition-colors line-clamp-2">{{ $ann->judul }}</h3>
                    <p class="text-sm text-[#8b949e] line-clamp-3">{{ strip_tags($ann->konten) }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
