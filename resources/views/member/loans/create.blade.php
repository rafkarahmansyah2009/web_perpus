@extends('layouts.member')
@section('title', 'Pinjam Buku')

@section('content')
<h1 class="text-2xl font-bold font-['Space_Grotesk'] mb-6">Ajukan Peminjaman Buku</h1>
<div class="card-dark p-6">
    <p class="text-[#8b949e] mb-4">Untuk meminjam buku, silakan kunjungi halaman <a href="/katalog" class="text-blue-400 hover:underline">Katalog</a> dan klik tombol "Ajukan Pinjam" pada buku yang ingin kamu pinjam.</p>
    <a href="/katalog" class="btn-gradient-sm">Buka Katalog</a>
</div>
@endsection
