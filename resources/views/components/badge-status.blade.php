@props(['book'])

@if($book->tersedia())
    <span class="badge-pill bg-green-500/10 text-green-400 border border-green-500/20">Tersedia</span>
@else
    <span class="badge-pill bg-red-500/10 text-red-400 border border-red-500/20">Dipinjam</span>
@endif
