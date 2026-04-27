@extends('layouts.app')
@section('title', 'Pengumuman — Portal Perpustakaan SMKN 5 Tangerang')

@section('content')
<div class="pt-24 pb-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold font-['Space_Grotesk'] mb-3">Pengumuman</h1>
            <p class="text-[#8b949e] max-w-xl mx-auto">Informasi dan berita terbaru dari perpustakaan</p>
        </div>

        @if($announcements->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($announcements as $ann)
                    <a href="/pengumuman/{{ $ann->slug }}" class="card-dark overflow-hidden group hover:border-blue-500/30 transition-all duration-300">
                        @if($ann->gambar)
                            <div class="aspect-video overflow-hidden">
                                <img src="{{ asset('storage/' . $ann->gambar) }}" alt="{{ $ann->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @else
                            <div class="aspect-video bg-gradient-to-br from-blue-500/10 to-violet-500/10 flex items-center justify-center">
                                <svg class="w-12 h-12 text-[#30363d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-xs text-blue-400 font-medium">{{ $ann->tgl_publish?->format('d M Y') }}</span>
                            </div>
                            <h3 class="font-semibold font-['Space_Grotesk'] mb-2 group-hover:text-blue-400 transition-colors line-clamp-2">{{ $ann->judul }}</h3>
                            <p class="text-sm text-[#8b949e] line-clamp-3">{{ strip_tags($ann->konten) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $announcements->links() }}
            </div>
        @else
            <div class="card-dark p-12 text-center">
                <svg class="w-16 h-16 text-[#30363d] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                <h3 class="text-lg font-semibold font-['Space_Grotesk'] mb-2">Belum ada pengumuman</h3>
                <p class="text-[#8b949e] text-sm">Pengumuman terbaru akan tampil di sini</p>
            </div>
        @endif
    </div>
</div>
@endsection
