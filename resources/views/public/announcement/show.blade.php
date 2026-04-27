@extends('layouts.app')
@section('title', $announcement->judul . ' — Portal Perpustakaan SMKN 5 Tangerang')

@section('content')
<div class="pt-24 pb-16">
    <div class="max-w-4xl mx-auto px-6">
        <a href="/pengumuman" class="inline-flex items-center gap-2 text-[#8b949e] hover:text-blue-400 transition-colors mb-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Pengumuman
        </a>

        <article class="card-dark p-8 md:p-10">
            <div class="flex items-center gap-3 mb-6">
                <span class="badge-pill bg-blue-500/10 text-blue-400 border border-blue-500/20">Pengumuman</span>
                <span class="text-sm text-[#8b949e]">{{ $announcement->tgl_publish?->format('d M Y') }}</span>
            </div>

            <h1 class="text-2xl md:text-3xl font-bold font-['Space_Grotesk'] mb-6">{{ $announcement->judul }}</h1>

            @if($announcement->gambar)
                <div class="rounded-2xl overflow-hidden mb-8">
                    <img src="{{ asset('storage/' . $announcement->gambar) }}" alt="{{ $announcement->judul }}" class="w-full object-cover">
                </div>
            @endif

            <div class="prose prose-invert max-w-none text-[#8b949e] leading-relaxed">
                {!! $announcement->konten !!}
            </div>
        </article>

        @if($recent->count())
            <div class="mt-12">
                <h3 class="text-xl font-bold font-['Space_Grotesk'] mb-6">Pengumuman Lainnya</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($recent as $ann)
                        <a href="/pengumuman/{{ $ann->slug }}" class="card-dark p-5 group hover:border-blue-500/30 transition-all duration-300">
                            <span class="text-xs text-blue-400 mb-2 block">{{ $ann->tgl_publish?->format('d M Y') }}</span>
                            <h4 class="font-semibold text-sm font-['Space_Grotesk'] group-hover:text-blue-400 transition-colors line-clamp-2">{{ $ann->judul }}</h4>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
