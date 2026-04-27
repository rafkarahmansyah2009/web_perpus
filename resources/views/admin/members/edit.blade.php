@extends('layouts.admin')
@section('title', 'Edit Anggota')
@section('breadcrumb', 'Anggota / Edit')

@section('content')
<div class="max-w-3xl">
    <h1 class="text-2xl font-bold font-['Space_Grotesk'] mb-6">Edit Anggota</h1>
    <form action="{{ route('admin.anggota.update', $member) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="card-dark p-6 space-y-5 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div><label class="block text-sm text-[#8b949e] mb-2">Nama *</label><input type="text" name="name" value="{{ old('name', $member->name) }}" required class="input-dark"></div>
                <div><label class="block text-sm text-[#8b949e] mb-2">Email *</label><input type="email" name="email" value="{{ old('email', $member->email) }}" required class="input-dark"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div><label class="block text-sm text-[#8b949e] mb-2">Password (kosongkan jika tidak diubah)</label><input type="password" name="password" class="input-dark"></div>
                <div><label class="block text-sm text-[#8b949e] mb-2">Role *</label>
                    <select name="role" required class="input-dark">
                        <option value="siswa" {{ $member->role=='siswa'?'selected':'' }}>Siswa</option>
                        <option value="guru" {{ $member->role=='guru'?'selected':'' }}>Guru</option>
                        <option value="admin" {{ $member->role=='admin'?'selected':'' }}>Admin</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div><label class="block text-sm text-[#8b949e] mb-2">NIS</label><input type="text" name="nis" value="{{ old('nis', $member->nis) }}" class="input-dark"></div>
                <div><label class="block text-sm text-[#8b949e] mb-2">NIP</label><input type="text" name="nip" value="{{ old('nip', $member->nip) }}" class="input-dark"></div>
                <div><label class="block text-sm text-[#8b949e] mb-2">Kelas</label><input type="text" name="kelas" value="{{ old('kelas', $member->kelas) }}" class="input-dark"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div><label class="block text-sm text-[#8b949e] mb-2">No. Telp</label><input type="text" name="no_telp" value="{{ old('no_telp', $member->no_telp) }}" class="input-dark"></div>
                <div><label class="block text-sm text-[#8b949e] mb-2">Status</label>
                    <select name="status_aktif" class="input-dark"><option value="1" {{ $member->status_aktif?'selected':'' }}>Aktif</option><option value="0" {{ !$member->status_aktif?'selected':'' }}>Nonaktif</option></select>
                </div>
            </div>
            <div><label class="block text-sm text-[#8b949e] mb-2">Foto</label>
                @if($member->foto)<div class="mb-2"><img src="{{ asset('storage/'.$member->foto) }}" class="w-16 h-16 rounded-full object-cover"></div>@endif
                <input type="file" name="foto" accept="image/*" class="input-dark text-sm">
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="btn-gradient">Simpan</button>
            <a href="{{ route('admin.anggota.index') }}" class="px-6 py-2.5 border border-[#30363d] rounded-xl text-sm hover:bg-[#1c2128]">Batal</a>
        </div>
    </form>
</div>
@endsection
