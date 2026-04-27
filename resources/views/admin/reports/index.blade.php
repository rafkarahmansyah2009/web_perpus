@extends('layouts.admin')
@section('title', 'Laporan')
@section('breadcrumb', 'Laporan')

@section('content')
<h1 class="text-2xl font-bold font-['Space_Grotesk'] mb-6">Laporan Peminjaman</h1>

{{-- Filter --}}
<div class="card-dark p-6 mb-6">
    <form action="{{ route('admin.laporan.index') }}" method="GET" class="flex flex-col sm:flex-row items-end gap-4">
        <div class="flex-1">
            <label class="block text-sm text-[#8b949e] mb-2">Dari Tanggal</label>
            <input type="date" name="dari" value="{{ request('dari') }}" class="input-dark">
        </div>
        <div class="flex-1">
            <label class="block text-sm text-[#8b949e] mb-2">Sampai Tanggal</label>
            <input type="date" name="sampai" value="{{ request('sampai') }}" class="input-dark">
        </div>
        <button type="submit" class="btn-gradient-sm py-3 px-6">Filter</button>
    </form>
</div>

{{-- Table --}}
<div class="card-dark overflow-hidden mb-6">
    <div class="overflow-x-auto">
        <table class="table-dark">
            <thead><tr><th>No</th><th>Anggota</th><th>Buku</th><th class="hidden md:table-cell">Tgl Pinjam</th><th class="hidden md:table-cell">Tgl Kembali</th><th>Status</th><th class="hidden lg:table-cell">Denda</th></tr></thead>
            <tbody>
                @forelse($loans as $i => $loan)
                <tr>
                    <td class="text-sm text-[#8b949e]">{{ $loans->firstItem() + $i }}</td>
                    <td class="text-sm">{{ $loan->user->name }}</td>
                    <td class="text-sm">{{ $loan->book->judul }}</td>
                    <td class="hidden md:table-cell text-sm text-[#8b949e]">{{ $loan->tgl_pinjam?->format('d/m/Y') }}</td>
                    <td class="hidden md:table-cell text-sm text-[#8b949e]">{{ $loan->tgl_kembali_aktual?->format('d/m/Y') ?? '-' }}</td>
                    <td>
                        @php $sc = ['pending'=>'text-yellow-400 bg-yellow-500/10','dipinjam'=>'text-blue-400 bg-blue-500/10','dikembalikan'=>'text-green-400 bg-green-500/10','terlambat'=>'text-red-400 bg-red-500/10']; @endphp
                        <span class="badge-pill {{ $sc[$loan->status] ?? '' }} border-0">{{ ucfirst($loan->status) }}</span>
                    </td>
                    <td class="hidden lg:table-cell text-sm">{{ $loan->fine ? 'Rp '.number_format($loan->fine->nominal_denda,0,',','.') : '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-8 text-[#8b949e]">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($loans->hasPages())<div class="p-4 border-t border-[#30363d]">{{ $loans->withQueryString()->links() }}</div>@endif
</div>

{{-- Export Buttons --}}
<div class="flex gap-3">
    <a href="{{ route('admin.laporan.export-pdf', request()->query()) }}" class="px-6 py-2.5 bg-red-500/10 text-red-400 border border-red-500/20 rounded-xl text-sm font-medium hover:bg-red-500/20 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        Export PDF
    </a>
    <a href="{{ route('admin.laporan.export-excel', request()->query()) }}" class="px-6 py-2.5 bg-green-500/10 text-green-400 border border-green-500/20 rounded-xl text-sm font-medium hover:bg-green-500/20 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        Export Excel
    </a>
</div>
@endsection
