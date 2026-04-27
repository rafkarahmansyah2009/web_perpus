@extends('layouts.admin')
@section('title', 'Kelola Buku')
@section('breadcrumb', 'Buku')

@section('content')
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
    <h1 class="text-2xl font-bold font-['Space_Grotesk']">Kelola Buku</h1>
    <div class="flex items-center gap-3">
        <button onclick="document.getElementById('import-modal').classList.remove('hidden')" class="px-4 py-2.5 border border-[#30363d] rounded-xl text-sm hover:bg-[#1c2128] transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
            Import Excel
        </button>
        <a href="{{ route('admin.buku.create') }}" class="btn-gradient-sm flex items-center gap-2 py-2.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Buku
        </a>
    </div>
</div>

{{-- Search & Filter --}}
<div class="card-dark p-4 mb-6">
    <form action="{{ route('admin.buku.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
        <div class="relative flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul, pengarang, ISBN..."
                class="input-dark pl-10 py-2.5 text-sm">
            <svg class="w-4 h-4 text-[#8b949e] absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
        <select name="kategori" onchange="this.form.submit()" class="input-dark py-2.5 text-sm w-full sm:w-48">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('kategori') == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
            @endforeach
        </select>
    </form>
</div>

{{-- Table --}}
<div class="card-dark overflow-hidden">
    <div class="overflow-x-auto">
        <table class="table-dark">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th class="hidden md:table-cell">Pengarang</th>
                    <th class="hidden lg:table-cell">Kategori</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-14 bg-[#1c2128] rounded-lg overflow-hidden flex-shrink-0">
                                    @if($book->cover)
                                        <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-[#30363d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-sm">{{ $book->judul }}</p>
                                    <p class="text-xs text-[#8b949e] md:hidden">{{ $book->pengarang }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="hidden md:table-cell text-sm text-[#8b949e]">{{ $book->pengarang }}</td>
                        <td class="hidden lg:table-cell">
                            <span class="badge-pill bg-blue-500/10 text-blue-400 border border-blue-500/20">{{ $book->kategori->nama ?? '-' }}</span>
                        </td>
                        <td class="text-sm font-medium">{{ $book->stok }}</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.buku.edit', $book) }}" class="p-2 rounded-lg hover:bg-blue-500/10 text-[#8b949e] hover:text-blue-400 transition-all" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('admin.buku.destroy', $book) }}" method="POST" onsubmit="return confirm('Hapus buku ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg hover:bg-red-500/10 text-[#8b949e] hover:text-red-400 transition-all" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-8 text-[#8b949e]">Belum ada data buku</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($books->hasPages())
        <div class="p-4 border-t border-[#30363d]">{{ $books->withQueryString()->links() }}</div>
    @endif
</div>

{{-- Import Modal --}}
<div id="import-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
    <div class="card-dark p-8 w-full max-w-md mx-4">
        <h3 class="text-lg font-bold font-['Space_Grotesk'] mb-4">Import Buku dari CSV</h3>
        <form action="{{ route('admin.buku.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <p class="text-sm text-[#8b949e] mb-4">Format CSV: isbn, judul, pengarang, penerbit, tahun_terbit, kategori_id, deskripsi, stok, lokasi_rak</p>
            <input type="file" name="file" accept=".csv,.xlsx,.xls" required class="input-dark mb-4 text-sm">
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('import-modal').classList.add('hidden')" class="flex-1 py-2.5 border border-[#30363d] rounded-xl text-sm hover:bg-[#1c2128] transition-all">Batal</button>
                <button type="submit" class="flex-1 btn-gradient-sm py-2.5">Import</button>
            </div>
        </form>
    </div>
</div>
@endsection
