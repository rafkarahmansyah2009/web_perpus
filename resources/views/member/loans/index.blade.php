@extends('layouts.member')
@section('title', 'Pinjaman Saya')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold font-['Space_Grotesk']">Pinjaman Saya</h1>
    <a href="/katalog" class="btn-gradient-sm py-2.5">Pinjam Buku</a>
</div>

<div class="card-dark overflow-hidden">
    <div class="overflow-x-auto">
        <table class="table-dark">
            <thead><tr><th>Buku</th><th class="hidden md:table-cell">Tgl Pinjam</th><th class="hidden md:table-cell">Tgl Kembali</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($loans as $loan)
                <tr class="{{ $loan->status=='terlambat'?'bg-red-500/5':'' }}">
                    <td class="text-sm font-medium">{{ $loan->book->judul }}</td>
                    <td class="hidden md:table-cell text-sm text-[#8b949e]">{{ $loan->tgl_pinjam?->format('d/m/Y') }}</td>
                    <td class="hidden md:table-cell text-sm text-[#8b949e]">{{ $loan->tgl_kembali_rencana?->format('d/m/Y') }}</td>
                    <td>
                        @php $sc=['pending'=>'text-yellow-400 bg-yellow-500/10','dipinjam'=>'text-blue-400 bg-blue-500/10','dikembalikan'=>'text-green-400 bg-green-500/10','terlambat'=>'text-red-400 bg-red-500/10']; @endphp
                        <span class="badge-pill {{ $sc[$loan->status]??'' }} border-0">{{ ucfirst($loan->status) }}</span>
                        @if($loan->fine)<br><span class="text-xs text-red-400">Denda: Rp {{ number_format($loan->fine->nominal_denda,0,',','.') }}</span>@endif
                    </td>
                    <td>
                        @if($loan->status=='dipinjam' && !$loan->sudah_diperpanjang)
                        <form action="{{ route('member.pinjaman.perpanjang',$loan->id) }}" method="POST">@csrf
                            <button class="px-3 py-1.5 rounded-lg bg-violet-500/10 text-violet-400 text-xs font-medium hover:bg-violet-500/20">Perpanjang</button>
                        </form>
                        @else<span class="text-xs text-[#8b949e]">—</span>@endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-8 text-[#8b949e]">Belum ada pinjaman</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($loans->hasPages())<div class="p-4 border-t border-[#30363d]">{{ $loans->links() }}</div>@endif
</div>
@endsection
