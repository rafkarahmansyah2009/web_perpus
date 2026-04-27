@extends('layouts.admin')
@section('title', 'Kelola Denda')
@section('breadcrumb', 'Denda')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold font-['Space_Grotesk']">Kelola Denda</h1>
        <p class="text-[#8b949e] text-sm mt-1">Total belum lunas: <span class="text-red-400 font-semibold">Rp {{ number_format($totalUnpaid, 0, ',', '.') }}</span></p>
    </div>
</div>

<div class="card-dark overflow-hidden">
    <div class="overflow-x-auto">
        <table class="table-dark">
            <thead><tr><th>Anggota</th><th>Buku</th><th class="hidden md:table-cell">Hari Terlambat</th><th>Nominal</th><th>Status</th><th class="hidden md:table-cell">Tgl Bayar</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($fines as $fine)
                <tr>
                    <td class="text-sm">{{ $fine->loan->user->name ?? '-' }}</td>
                    <td class="text-sm">{{ $fine->loan->book->judul ?? '-' }}</td>
                    <td class="hidden md:table-cell text-sm text-[#8b949e]">{{ $fine->jumlah_hari }} hari</td>
                    <td class="text-sm font-semibold text-red-400">Rp {{ number_format($fine->nominal_denda, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge-pill {{ $fine->status_bayar=='lunas'?'text-green-400 bg-green-500/10 border-green-500/20':'text-red-400 bg-red-500/10 border-red-500/20' }} border">{{ ucfirst($fine->status_bayar) }}</span>
                    </td>
                    <td class="hidden md:table-cell text-sm text-[#8b949e]">{{ $fine->tgl_bayar?->format('d/m/Y') ?? '-' }}</td>
                    <td>
                        @if($fine->status_bayar == 'belum')
                        <form action="{{ route('admin.denda.lunas', $fine->id) }}" method="POST" onsubmit="return confirm('Konfirmasi denda lunas?')">
                            @csrf
                            <button class="px-3 py-1.5 rounded-lg bg-green-500/10 text-green-400 text-xs font-medium hover:bg-green-500/20 transition-all">Konfirmasi Lunas</button>
                        </form>
                        @else
                        <span class="text-xs text-[#8b949e]">Lunas</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-8 text-[#8b949e]">Belum ada data denda</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($fines->hasPages())<div class="p-4 border-t border-[#30363d]">{{ $fines->links() }}</div>@endif
</div>
@endsection
