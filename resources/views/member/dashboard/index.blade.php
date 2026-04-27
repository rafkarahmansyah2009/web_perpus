@extends('layouts.member')
@section('title', 'Dashboard — Portal Perpustakaan')

@section('content')
{{-- Greeting Card --}}
<div class="card-dark p-8 mb-8 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl from-blue-500/10 to-transparent rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="relative">
        <p class="text-[#8b949e] text-sm mb-1">{{ $greeting }},</p>
        <h1 class="text-3xl font-bold font-['Space_Grotesk'] mb-2">{{ $user->name }} 👋</h1>
        <p class="text-[#8b949e]">Selamat datang kembali di Portal Perpustakaan Digital SMKN 5 Tangerang</p>
    </div>
</div>

{{-- Notifications --}}
@if($overdueLoans->count())
<div class="bg-red-500/10 border border-red-500/30 rounded-2xl p-5 mb-6 flex items-start gap-3">
    <div class="w-10 h-10 bg-red-500/20 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
    </div>
    <div>
        <h3 class="text-red-400 font-semibold text-sm mb-1">Buku Terlambat!</h3>
        <p class="text-red-300/80 text-sm">Kamu memiliki {{ $overdueLoans->count() }} buku yang terlambat dikembalikan. Segera kembalikan untuk menghindari denda.</p>
    </div>
</div>
@endif

@if($dueSoon->count())
<div class="bg-yellow-500/10 border border-yellow-500/30 rounded-2xl p-5 mb-6 flex items-start gap-3">
    <div class="w-10 h-10 bg-yellow-500/20 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    </div>
    <div>
        <h3 class="text-yellow-400 font-semibold text-sm mb-1">Mendekati Jatuh Tempo</h3>
        <p class="text-yellow-300/80 text-sm">{{ $dueSoon->count() }} buku mendekati tanggal pengembalian. Jangan lupa kembalikan tepat waktu!</p>
    </div>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    {{-- Member Card --}}
    <div class="card-dark p-6 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-violet-500/5"></div>
        <div class="relative">
            <h3 class="text-sm text-[#8b949e] mb-4 font-medium">Kartu Anggota Digital</h3>
            <div class="flex items-center gap-4 mb-4">
                @if($user->foto)
                    <img src="{{ asset('storage/' . $user->foto) }}" class="w-16 h-16 rounded-2xl object-cover border-2 border-[#30363d]">
                @else
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-violet-500 rounded-2xl flex items-center justify-center text-white text-2xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <h4 class="font-bold font-['Space_Grotesk']">{{ $user->name }}</h4>
                    <p class="text-xs text-[#8b949e]">{{ ucfirst($user->role) }} — {{ $user->kelas ?? '-' }}</p>
                    <p class="text-xs text-blue-400 font-mono mt-1">{{ $user->nis ?? $user->nip ?? 'ID: '.$user->id }}</p>
                </div>
            </div>
            {{-- QR Code --}}
            <div class="flex items-center justify-center p-4 bg-white rounded-xl">
                <div class="text-center">
                    <div class="w-24 h-24 bg-white flex items-center justify-center mx-auto mb-2">
                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(96)->margin(0)->generate('QR-' . str_pad($user->id, 5, '0', STR_PAD_LEFT)) !!}
                    </div>
                    <p class="text-[#0d1117] text-xs font-medium">SMKN 5 Tangerang</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats --}}
    <div class="space-y-4">
        <div class="card-dark p-5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-blue-500/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/></svg>
                </div>
                <div>
                    <h4 class="text-2xl font-bold font-['Space_Grotesk']">{{ $totalBorrowed }}</h4>
                    <p class="text-xs text-[#8b949e]">Total Pernah Dipinjam</p>
                </div>
            </div>
        </div>
        <div class="card-dark p-5">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-violet-500/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                </div>
                <div>
                    <h4 class="text-2xl font-bold font-['Space_Grotesk']">{{ $currentlyBorrowed }}</h4>
                    <p class="text-xs text-[#8b949e]">Sedang Dipinjam</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="space-y-4">
        <a href="/katalog" class="card-dark p-5 flex items-center gap-4 group hover:border-blue-500/30 transition-all">
            <div class="w-11 h-11 bg-blue-500/10 rounded-xl flex items-center justify-center group-hover:bg-blue-500/20 transition-colors">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <div>
                <h4 class="font-semibold text-sm">Cari Buku</h4>
                <p class="text-xs text-[#8b949e]">Jelajahi katalog perpustakaan</p>
            </div>
        </a>
        <a href="/member/pinjaman" class="card-dark p-5 flex items-center gap-4 group hover:border-violet-500/30 transition-all">
            <div class="w-11 h-11 bg-violet-500/10 rounded-xl flex items-center justify-center group-hover:bg-violet-500/20 transition-colors">
                <svg class="w-5 h-5 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <div>
                <h4 class="font-semibold text-sm">Riwayat Pinjaman</h4>
                <p class="text-xs text-[#8b949e]">Lihat semua pinjaman kamu</p>
            </div>
        </a>
    </div>
</div>

{{-- Active Loans --}}
<h2 class="text-xl font-bold font-['Space_Grotesk'] mb-4">Pinjaman Aktif</h2>
@if($activeLoans->count())
<div class="space-y-3">
    @foreach($activeLoans as $loan)
    <div class="card-dark p-5 flex flex-col sm:flex-row items-start sm:items-center gap-4 {{ $loan->status == 'terlambat' ? 'border-red-500/30' : '' }}">
        <div class="w-12 h-16 bg-[#1c2128] rounded-lg overflow-hidden flex-shrink-0">
            @if($loan->book->cover)
                <img src="{{ asset('storage/' . $loan->book->cover) }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#30363d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13"/></svg>
                </div>
            @endif
        </div>
        <div class="flex-1 min-w-0">
            <h4 class="font-semibold text-sm">{{ $loan->book->judul }}</h4>
            <p class="text-xs text-[#8b949e]">Kembali: {{ $loan->tgl_kembali_rencana?->format('d M Y') }}</p>
        </div>
        <div class="flex items-center gap-2">
            @php $sc = ['pending'=>'text-yellow-400 bg-yellow-500/10','dipinjam'=>'text-blue-400 bg-blue-500/10','terlambat'=>'text-red-400 bg-red-500/10']; @endphp
            <span class="badge-pill {{ $sc[$loan->status] ?? '' }} border-0">{{ ucfirst($loan->status) }}</span>

            @if($loan->status == 'dipinjam' && !$loan->sudah_diperpanjang)
            <form action="{{ route('member.pinjaman.perpanjang', $loan->id) }}" method="POST">
                @csrf
                <button class="px-3 py-1.5 rounded-lg bg-violet-500/10 text-violet-400 text-xs font-medium hover:bg-violet-500/20 transition-all">Perpanjang</button>
            </form>
            @endif
        </div>
    </div>
    @endforeach
</div>
@else
<div class="card-dark p-8 text-center">
    <svg class="w-12 h-12 text-[#30363d] mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
    <h3 class="font-semibold font-['Space_Grotesk'] mb-1">Belum ada pinjaman aktif</h3>
    <p class="text-sm text-[#8b949e] mb-4">Mulai jelajahi katalog dan pinjam buku favoritmu</p>
    <a href="/katalog" class="btn-gradient-sm">Jelajahi Katalog</a>
</div>
@endif
@endsection
