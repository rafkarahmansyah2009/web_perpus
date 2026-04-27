@extends('layouts.admin')
@section('title', 'Kelola Anggota')
@section('breadcrumb', 'Anggota')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold font-['Space_Grotesk']">Kelola Anggota</h1>
    <a href="{{ route('admin.anggota.create') }}" class="btn-gradient-sm flex items-center gap-2 py-2.5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Anggota
    </a>
</div>

<div class="card-dark p-4 mb-6">
    <form action="{{ route('admin.anggota.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
        <div class="relative flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, NIS, NIP..." class="input-dark pl-10 py-2.5 text-sm">
            <svg class="w-4 h-4 text-[#8b949e] absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
        <select name="role" onchange="this.form.submit()" class="input-dark py-2.5 text-sm w-full sm:w-40">
            <option value="">Semua Role</option>
            <option value="guru" {{ request('role')=='guru'?'selected':'' }}>Guru</option>
            <option value="siswa" {{ request('role')=='siswa'?'selected':'' }}>Siswa</option>
        </select>
    </form>
</div>

<div class="card-dark overflow-hidden">
    <div class="overflow-x-auto">
        <table class="table-dark">
            <thead><tr><th>Anggota</th><th class="hidden md:table-cell">Role</th><th class="hidden lg:table-cell">NIS/NIP</th><th class="hidden md:table-cell">Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($members as $m)
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-violet-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                                @if($m->foto)<img src="{{ asset('storage/'.$m->foto) }}" class="w-9 h-9 rounded-full object-cover">@else{{ strtoupper(substr($m->name,0,1)) }}@endif
                            </div>
                            <div>
                                <p class="font-medium text-sm">{{ $m->name }}</p>
                                <p class="text-xs text-[#8b949e]">{{ $m->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="hidden md:table-cell">
                        @php $rc = ['guru'=>'text-violet-400 bg-violet-500/10 border-violet-500/20','siswa'=>'text-blue-400 bg-blue-500/10 border-blue-500/20']; @endphp
                        <span class="badge-pill {{ $rc[$m->role] ?? '' }} border">{{ ucfirst($m->role) }}</span>
                    </td>
                    <td class="hidden lg:table-cell text-sm text-[#8b949e]">{{ $m->nis ?: $m->nip ?: '-' }}</td>
                    <td class="hidden md:table-cell">
                        <span class="badge-pill {{ $m->status_aktif ? 'text-green-400 bg-green-500/10 border-green-500/20' : 'text-red-400 bg-red-500/10 border-red-500/20' }} border">{{ $m->status_aktif ? 'Aktif' : 'Nonaktif' }}</span>
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.anggota.edit', $m) }}" class="p-2 rounded-lg hover:bg-blue-500/10 text-[#8b949e] hover:text-blue-400 transition-all"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                            <form action="{{ route('admin.anggota.destroy', $m) }}" method="POST" onsubmit="return confirm('Hapus anggota ini?')">@csrf @method('DELETE')
                                <button class="p-2 rounded-lg hover:bg-red-500/10 text-[#8b949e] hover:text-red-400 transition-all"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-8 text-[#8b949e]">Belum ada data anggota</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($members->hasPages())<div class="p-4 border-t border-[#30363d]">{{ $members->withQueryString()->links() }}</div>@endif
</div>
@endsection
