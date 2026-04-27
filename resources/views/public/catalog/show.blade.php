@extends('layouts.app')
@section('title', $book->judul . ' — Portal Perpustakaan SMKN 5 Tangerang')

@section('content')
<div class="pt-24 pb-16">
    <div class="max-w-6xl mx-auto px-6">
        {{-- Back --}}
        <a href="/katalog" class="inline-flex items-center gap-2 text-[#8b949e] hover:text-blue-400 transition-colors mb-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Katalog
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            {{-- Cover --}}
            <div class="lg:col-span-1">
                <div class="card-dark overflow-hidden sticky top-24">
                    <div class="aspect-[3/4] bg-[#1c2128]">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500/20 to-violet-500/20">
                                <svg class="w-24 h-24 text-[#30363d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-4 flex items-center gap-2 flex-wrap">
                        @if($book->kategori)
                            <span class="badge-pill bg-blue-500/10 text-blue-400 border border-blue-500/20">{{ $book->kategori->nama }}</span>
                        @endif
                        @include('components.badge-status', ['book' => $book])
                        <span class="badge-pill bg-[#1c2128] text-[#8b949e] border border-[#30363d]">Stok: {{ $book->stokTersedia() }}</span>
                    </div>
                </div>
            </div>

            {{-- Details --}}
            <div class="lg:col-span-2">
                <h1 class="text-3xl md:text-4xl font-bold font-['Space_Grotesk'] mb-2">{{ $book->judul }}</h1>
                <p class="text-lg text-[#8b949e] mb-8">oleh {{ $book->pengarang }}</p>

                {{-- Info Grid --}}
                <div class="card-dark p-6 mb-8">
                    <h3 class="font-semibold font-['Space_Grotesk'] mb-4 text-[#8b949e]">Informasi Buku</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#1c2128] rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-[#8b949e]">ISBN</p>
                                <p class="text-sm font-medium">{{ $book->isbn ?: '-' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#1c2128] rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-[#8b949e]">Penerbit</p>
                                <p class="text-sm font-medium">{{ $book->penerbit ?: '-' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#1c2128] rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-[#8b949e]">Tahun Terbit</p>
                                <p class="text-sm font-medium">{{ $book->tahun_terbit ?: '-' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#1c2128] rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-[#8b949e]">Lokasi Rak</p>
                                <p class="text-sm font-medium">{{ $book->lokasi_rak ?: '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Borrow Button --}}
                @auth
                    @if(Auth::user()->isMember() && $book->tersedia())
                        <form action="{{ route('member.pinjaman.store') }}" method="POST" class="mb-8">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button type="submit" class="w-full btn-gradient py-4 text-base flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Ajukan Pinjam Buku
                            </button>
                        </form>
                    @elseif(Auth::user()->isMember() && !$book->tersedia())
                        <div class="w-full bg-red-500/10 border border-red-500/30 rounded-xl py-4 text-center text-red-400 font-medium mb-8">
                            Buku sedang tidak tersedia
                        </div>
                    @endif
                @else
                    <a href="/login" class="w-full btn-gradient py-4 text-base flex items-center justify-center gap-2 mb-8">
                        Masuk untuk Meminjam
                    </a>
                @endauth

                {{-- Description --}}
                @if($book->deskripsi)
                    <div class="card-dark p-6">
                        <h3 class="font-semibold font-['Space_Grotesk'] mb-4">Deskripsi / Sinopsis</h3>
                        <div class="text-[#8b949e] text-sm leading-relaxed">
                            {!! nl2br(e($book->deskripsi)) !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
