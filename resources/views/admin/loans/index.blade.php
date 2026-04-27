@extends('layouts.admin')
@section('title', 'Kelola Peminjaman')
@section('breadcrumb', 'Peminjaman')

@section('content')
<h1 class="text-2xl font-bold font-['Space_Grotesk'] mb-6">Kelola Peminjaman</h1>

{{-- Status Tabs --}}
<div class="flex flex-wrap gap-2 mb-6">
    @php $statuses = ['' => 'Semua', 'pending' => 'Pending', 'dipinjam' => 'Dipinjam', 'terlambat' => 'Terlambat', 'dikembalikan' => 'Dikembalikan']; @endphp
    @foreach($statuses as $val => $label)
        <a href="{{ route('admin.peminjaman.index', ['status' => $val]) }}" class="px-4 py-2 rounded-xl text-sm transition-all {{ request('status', '') == $val ? 'bg-blue-500/20 text-blue-400 border border-blue-500/30' : 'bg-[#161b22] text-[#8b949e] border border-[#30363d] hover:text-white hover:bg-[#1c2128]' }}">{{ $label }}</a>
    @endforeach
</div>

<div class="card-dark overflow-hidden">
    <div class="overflow-x-auto">
        <table class="table-dark">
            <thead><tr><th>Anggota</th><th>Buku</th><th class="hidden md:table-cell">Tgl Pinjam</th><th class="hidden md:table-cell">Tgl Kembali</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($loans as $loan)
                <tr class="{{ $loan->status == 'terlambat' ? 'bg-red-500/5' : '' }}">
                    <td class="text-sm">{{ $loan->user->name }}</td>
                    <td class="text-sm">{{ $loan->book->judul }}</td>
                    <td class="hidden md:table-cell text-sm text-[#8b949e]">{{ $loan->tgl_pinjam?->format('d/m/Y') }}</td>
                    <td class="hidden md:table-cell text-sm text-[#8b949e]">{{ $loan->tgl_kembali_rencana?->format('d/m/Y') }}</td>
                    <td>
                        @php $sc = ['pending'=>'text-yellow-400 bg-yellow-500/10 border-yellow-500/20','dipinjam'=>'text-blue-400 bg-blue-500/10 border-blue-500/20','dikembalikan'=>'text-green-400 bg-green-500/10 border-green-500/20','terlambat'=>'text-red-400 bg-red-500/10 border-red-500/20']; @endphp
                        <span class="badge-pill {{ $sc[$loan->status] ?? '' }} border">{{ ucfirst($loan->status) }}</span>
                    </td>
                    <td>
                        <div class="flex items-center gap-1">
                            @if($loan->status == 'pending')
                            <form action="{{ route('admin.peminjaman.konfirmasi', $loan->id) }}" method="POST">@csrf
                                <button class="px-3 py-1.5 rounded-lg bg-green-500/10 text-green-400 text-xs font-medium hover:bg-green-500/20 transition-all">Konfirmasi</button>
                            </form>
                            @elseif(in_array($loan->status, ['dipinjam', 'terlambat']))
                            <form action="{{ route('admin.peminjaman.kembalikan', $loan->id) }}" method="POST">@csrf
                                <button class="px-3 py-1.5 rounded-lg bg-blue-500/10 text-blue-400 text-xs font-medium hover:bg-blue-500/20 transition-all">Kembalikan</button>
                            </form>
                            @endif
                            <a href="{{ route('admin.peminjaman.show', $loan->id) }}" class="p-2 rounded-lg hover:bg-[#1c2128] text-[#8b949e] hover:text-white transition-all"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-8 text-[#8b949e]">Belum ada data peminjaman</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($loans->hasPages())<div class="p-4 border-t border-[#30363d]">{{ $loans->withQueryString()->links() }}</div>@endif
</div>
@endsection
