@extends('layouts.admin')
@section('title', 'Tambah Anggota')
@section('breadcrumb', 'Anggota / Tambah')

@section('content')
<div class="max-w-3xl">
    <h1 class="text-2xl font-bold font-['Space_Grotesk'] mb-6">Tambah Anggota</h1>
    <form action="{{ route('admin.anggota.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-dark p-6 space-y-5 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div><label class="block text-sm text-[#8b949e] mb-2">Nama *</label><input type="text" name="name" value="{{ old('name') }}" required class="input-dark">@error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror</div>
                <div><label class="block text-sm text-[#8b949e] mb-2">Email *</label><input type="email" name="email" value="{{ old('email') }}" required class="input-dark">@error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror</div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div><label class="block text-sm text-[#8b949e] mb-2">Password *</label><input type="password" name="password" required class="input-dark"></div>
                <div><label class="block text-sm text-[#8b949e] mb-2">Role *</label>
                    <select name="role" required class="input-dark">
                        <option value="siswa" {{ old('role')=='siswa'?'selected':'' }}>Siswa</option>
                        <option value="guru" {{ old('role')=='guru'?'selected':'' }}>Guru</option>
                        <option value="admin" {{ old('role')=='admin'?'selected':'' }}>Admin</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div><label class="block text-sm text-[#8b949e] mb-2">NIS</label><input type="text" name="nis" value="{{ old('nis') }}" class="input-dark"></div>
                <div><label class="block text-sm text-[#8b949e] mb-2">NIP</label><input type="text" name="nip" value="{{ old('nip') }}" class="input-dark"></div>
                <div><label class="block text-sm text-[#8b949e] mb-2">Kelas</label><input type="text" name="kelas" value="{{ old('kelas') }}" class="input-dark"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div><label class="block text-sm text-[#8b949e] mb-2">No. Telp</label><input type="text" name="no_telp" value="{{ old('no_telp') }}" class="input-dark"></div>
                <div><label class="block text-sm text-[#8b949e] mb-2">Status</label>
                    <select name="status_aktif" class="input-dark"><option value="1">Aktif</option><option value="0">Nonaktif</option></select>
                </div>
            </div>
            <div><label class="block text-sm text-[#8b949e] mb-2">Foto</label><input type="file" name="foto" accept="image/*" class="input-dark text-sm"></div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="btn-gradient">Simpan</button>
            <a href="{{ route('admin.anggota.index') }}" class="px-6 py-2.5 border border-[#30363d] rounded-xl text-sm hover:bg-[#1c2128]">Batal</a>
        </div>
    </form>
</div>
@endsection
