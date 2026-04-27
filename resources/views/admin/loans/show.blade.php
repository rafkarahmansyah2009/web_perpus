@extends('layouts.admin')
@section('title', 'Detail Peminjaman')
@section('breadcrumb', 'Peminjaman / Detail')

@section('content')
<a href="{{ route('admin.peminjaman.index') }}" class="inline-flex items-center gap-2 text-[#8b949e] hover:text-blue-400 transition-colors mb-6">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    Kembali
</a>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="card-dark p-6">
        <h3 class="font-semibold font-['Space_Grotesk'] mb-4">Info Peminjaman</h3>
        <dl class="space-y-3">
            <div class="flex justify-between"><dt class="text-[#8b949e] text-sm">Anggota</dt><dd class="text-sm font-medium">{{ $loan->user->name }}</dd></div>
            <div class="flex justify-between"><dt class="text-[#8b949e] text-sm">Buku</dt><dd class="text-sm font-medium">{{ $loan->book->judul }}</dd></div>
            <div class="flex justify-between"><dt class="text-[#8b949e] text-sm">Tgl Pinjam</dt><dd class="text-sm">{{ $loan->tgl_pinjam?->format('d M Y') }}</dd></div>
            <div class="flex justify-between"><dt class="text-[#8b949e] text-sm">Tgl Kembali Rencana</dt><dd class="text-sm">{{ $loan->tgl_kembali_rencana?->format('d M Y') }}</dd></div>
            <div class="flex justify-between"><dt class="text-[#8b949e] text-sm">Tgl Kembali Aktual</dt><dd class="text-sm">{{ $loan->tgl_kembali_aktual?->format('d M Y') ?? '-' }}</dd></div>
            <div class="flex justify-between"><dt class="text-[#8b949e] text-sm">Status</dt><dd>
                @php $sc = ['pending'=>'text-yellow-400 bg-yellow-500/10 border-yellow-500/20','dipinjam'=>'text-blue-400 bg-blue-500/10 border-blue-500/20','dikembalikan'=>'text-green-400 bg-green-500/10 border-green-500/20','terlambat'=>'text-red-400 bg-red-500/10 border-red-500/20']; @endphp
                <span class="badge-pill {{ $sc[$loan->status] ?? '' }} border">{{ ucfirst($loan->status) }}</span>
            </dd></div>
            <div class="flex justify-between"><dt class="text-[#8b949e] text-sm">Diperpanjang</dt><dd class="text-sm">{{ $loan->sudah_diperpanjang ? 'Ya' : 'Belum' }}</dd></div>
        </dl>
    </div>

    @if($loan->fine)
    <div class="card-dark p-6">
        <h3 class="font-semibold font-['Space_Grotesk'] mb-4">Info Denda</h3>
        <dl class="space-y-3">
            <div class="flex justify-between"><dt class="text-[#8b949e] text-sm">Hari Terlambat</dt><dd class="text-sm font-medium text-red-400">{{ $loan->fine->jumlah_hari }} hari</dd></div>
            <div class="flex justify-between"><dt class="text-[#8b949e] text-sm">Nominal</dt><dd class="text-sm font-bold text-red-400">Rp {{ number_format($loan->fine->nominal_denda,0,',','.') }}</dd></div>
            <div class="flex justify-between"><dt class="text-[#8b949e] text-sm">Status Bayar</dt><dd><span class="badge-pill {{ $loan->fine->status_bayar=='lunas'?'text-green-400 bg-green-500/10':'text-red-400 bg-red-500/10' }} border-0">{{ ucfirst($loan->fine->status_bayar) }}</span></dd></div>
        </dl>
    </div>
    @endif
</div>
@endsection
