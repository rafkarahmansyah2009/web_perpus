@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('breadcrumb', 'Dashboard')

@section('content')
{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="card-dark p-6 group hover:border-blue-500/30 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-500/10 rounded-2xl flex items-center justify-center group-hover:bg-blue-500/20 transition-colors">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
        </div>
        <h3 class="text-2xl font-bold font-['Space_Grotesk']">{{ number_format($totalBooks) }}</h3>
        <p class="text-sm text-[#8b949e] mt-1">Total Buku</p>
    </div>
    <div class="card-dark p-6 group hover:border-violet-500/30 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-violet-500/10 rounded-2xl flex items-center justify-center group-hover:bg-violet-500/20 transition-colors">
                <svg class="w-6 h-6 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
        </div>
        <h3 class="text-2xl font-bold font-['Space_Grotesk']">{{ number_format($activeMembers) }}</h3>
        <p class="text-sm text-[#8b949e] mt-1">Anggota Aktif</p>
    </div>
    <div class="card-dark p-6 group hover:border-yellow-500/30 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-yellow-500/10 rounded-2xl flex items-center justify-center group-hover:bg-yellow-500/20 transition-colors">
                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            </div>
        </div>
        <h3 class="text-2xl font-bold font-['Space_Grotesk']">{{ number_format($currentlyBorrowed) }}</h3>
        <p class="text-sm text-[#8b949e] mt-1">Sedang Dipinjam</p>
    </div>
    <div class="card-dark p-6 group hover:border-red-500/30 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-red-500/10 rounded-2xl flex items-center justify-center group-hover:bg-red-500/20 transition-colors">
                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <h3 class="text-2xl font-bold font-['Space_Grotesk']">Rp {{ number_format($unpaidFines, 0, ',', '.') }}</h3>
        <p class="text-sm text-[#8b949e] mt-1">Denda Belum Lunas</p>
    </div>
</div>

{{-- Charts Row --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="card-dark p-6">
        <h3 class="font-semibold font-['Space_Grotesk'] mb-4">Peminjaman 6 Bulan Terakhir</h3>
        <canvas id="loanChart" height="200"></canvas>
    </div>
    <div class="card-dark p-6">
        <h3 class="font-semibold font-['Space_Grotesk'] mb-4">Distribusi Kategori Buku</h3>
        <canvas id="categoryChart" height="200"></canvas>
    </div>
</div>

{{-- Recent & Due Soon --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="card-dark p-6">
        <h3 class="font-semibold font-['Space_Grotesk'] mb-4">Transaksi Terbaru</h3>
        <div class="space-y-3">
            @forelse($recentLoans as $loan)
                <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#1c2128] transition-colors">
                    <div class="w-10 h-10 bg-blue-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate">{{ $loan->user->name }}</p>
                        <p class="text-xs text-[#8b949e] truncate">{{ $loan->book->judul }}</p>
                    </div>
                    @php
                        $statusColors = ['pending' => 'text-yellow-400 bg-yellow-500/10', 'dipinjam' => 'text-blue-400 bg-blue-500/10', 'dikembalikan' => 'text-green-400 bg-green-500/10', 'terlambat' => 'text-red-400 bg-red-500/10'];
                    @endphp
                    <span class="badge-pill {{ $statusColors[$loan->status] ?? '' }} border-0 text-xs">{{ ucfirst($loan->status) }}</span>
                </div>
            @empty
                <p class="text-sm text-[#8b949e] text-center py-4">Belum ada transaksi</p>
            @endforelse
        </div>
    </div>

    <div class="card-dark p-6">
        <h3 class="font-semibold font-['Space_Grotesk'] mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
            Mendekati Jatuh Tempo
        </h3>
        <div class="space-y-3">
            @forelse($dueSoon as $loan)
                <div class="flex items-center gap-3 p-3 rounded-xl bg-yellow-500/5 border border-yellow-500/10">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate">{{ $loan->book->judul }}</p>
                        <p class="text-xs text-[#8b949e]">{{ $loan->user->name }} — Jatuh tempo: {{ $loan->tgl_kembali_rencana->format('d M Y') }}</p>
                    </div>
                    <span class="text-xs text-yellow-400 font-medium whitespace-nowrap">{{ $loan->tgl_kembali_rencana->diffInDays(now()) }} hari lagi</span>
                </div>
            @empty
                <p class="text-sm text-[#8b949e] text-center py-4">Tidak ada buku mendekati jatuh tempo</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Loan Chart
    new Chart(document.getElementById('loanChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode(collect($loanChartData)->pluck('month')) !!},
            datasets: [{
                label: 'Peminjaman',
                data: {!! json_encode(collect($loanChartData)->pluck('count')) !!},
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#3b82f6',
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { color: '#30363d' }, ticks: { color: '#8b949e' } },
                y: { grid: { color: '#30363d' }, ticks: { color: '#8b949e', stepSize: 1 }, beginAtZero: true }
            }
        }
    });

    // Category Chart
    new Chart(document.getElementById('categoryChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($categoryData->pluck('name')) !!},
            datasets: [{
                data: {!! json_encode($categoryData->pluck('count')) !!},
                backgroundColor: ['#3b82f6', '#8b5cf6', '#10b981', '#f59e0b', '#ef4444'],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom', labels: { color: '#8b949e', padding: 16 } }
            }
        }
    });
</script>
@endpush
