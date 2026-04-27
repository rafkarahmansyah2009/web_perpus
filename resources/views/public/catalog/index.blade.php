@extends('layouts.app')
@section('title', 'Katalog Buku — Portal Perpustakaan SMKN 5 Tangerang')

@section('content')
<div class="pt-24 pb-16">
    <div class="max-w-7xl mx-auto px-6">
        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold font-['Space_Grotesk'] mb-3">Katalog Buku</h1>
            <p class="text-[#8b949e] max-w-xl mx-auto">Temukan buku yang kamu cari dari koleksi perpustakaan kami</p>
        </div>

        {{-- Search Bar --}}
        <div class="max-w-2xl mx-auto mb-10">
            <form action="/katalog" method="GET" class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul, pengarang, atau ISBN..."
                    class="input-dark pl-12 py-4 text-base">
                <svg class="w-5 h-5 text-[#8b949e] absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                @if(request('search'))
                    <a href="/katalog" class="absolute right-4 top-1/2 -translate-y-1/2 text-[#8b949e] hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
            </form>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Sidebar Filters --}}
            <aside class="lg:w-64 flex-shrink-0">
                <div class="card-dark p-6 sticky top-24">
                    <h3 class="font-semibold font-['Space_Grotesk'] mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        Filter
                    </h3>

                    <form action="/katalog" method="GET">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <div class="mb-6">
                            <p class="text-sm text-[#8b949e] mb-3 font-medium">Kategori</p>
                            <div class="space-y-2">
                                @foreach($categories as $cat)
                                    <label class="flex items-center gap-2 text-sm cursor-pointer hover:text-white transition-colors">
                                        <input type="checkbox" name="kategori[]" value="{{ $cat->id }}"
                                            {{ in_array($cat->id, (array)request('kategori', [])) ? 'checked' : '' }}
                                            class="w-4 h-4 rounded bg-[#0d1117] border-[#30363d] text-blue-500 focus:ring-blue-500 focus:ring-offset-0"
                                            onchange="this.form.submit()">
                                        <span class="text-[#8b949e]">{{ $cat->nama }}</span>
                                        <span class="text-xs text-[#484f58] ml-auto">({{ $cat->books_count }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
            </aside>

            {{-- Books Grid --}}
            <div class="flex-1">
                @if($books->count())
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                        @foreach($books as $book)
                            @include('components.book-card', ['book' => $book])
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $books->withQueryString()->links() }}
                    </div>
                @else
                    <div class="card-dark p-12 text-center">
                        <svg class="w-16 h-16 text-[#30363d] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <h3 class="text-lg font-semibold font-['Space_Grotesk'] mb-2">Buku tidak ditemukan</h3>
                        <p class="text-[#8b949e] text-sm">Coba ubah kata kunci pencarian atau filter</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
