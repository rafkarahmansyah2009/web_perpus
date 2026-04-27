@props(['book'])

<div class="card-dark overflow-hidden group hover:border-blue-500/30 transition-all duration-300">
    <div class="relative aspect-[3/4] overflow-hidden bg-[#1c2128]">
        @if($book->cover)
            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500/20 to-violet-500/20">
                <svg class="w-16 h-16 text-[#30363d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
        @endif
        {{-- Hover overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-6">
            <a href="/katalog/{{ $book->id }}" class="btn-gradient-sm">Lihat Detail</a>
        </div>
    </div>
    <div class="p-4">
        <h3 class="font-semibold text-sm line-clamp-2 mb-1 font-['Space_Grotesk'] group-hover:text-blue-400 transition-colors">{{ $book->judul }}</h3>
        <p class="text-xs text-[#8b949e] mb-3">{{ $book->pengarang }}</p>
        <div class="flex items-center gap-2 flex-wrap">
            @if($book->kategori)
                <span class="badge-pill bg-blue-500/10 text-blue-400 border border-blue-500/20">{{ $book->kategori->nama }}</span>
            @endif
            @include('components.badge-status', ['book' => $book])
        </div>
    </div>
</div>
