@extends('layouts.member')
@section('title', 'Edit Profil')

@section('content')
<h1 class="text-2xl font-bold font-['Space_Grotesk'] mb-6">Edit Profil</h1>

<div class="max-w-2xl">
    <form action="{{ route('member.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="card-dark p-6 space-y-5 mb-6">
            {{-- Avatar --}}
            <div class="flex items-center gap-4">
                @if($user->foto)
                    <img src="{{ asset('storage/' . $user->foto) }}" class="w-20 h-20 rounded-2xl object-cover border-2 border-[#30363d]">
                @else
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-violet-500 rounded-2xl flex items-center justify-center text-white text-3xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <h3 class="font-semibold">{{ $user->name }}</h3>
                    <p class="text-sm text-[#8b949e]">{{ $user->email }}</p>
                    <p class="text-xs text-blue-400">{{ ucfirst($user->role) }} {{ $user->kelas ? '— ' . $user->kelas : '' }}</p>
                </div>
            </div>

            <div>
                <label class="block text-sm text-[#8b949e] mb-2">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" autocomplete="off" required class="input-dark">
                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm text-[#8b949e] mb-2">No. Telepon</label>
                <input type="text" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" autocomplete="off" class="input-dark">
            </div>

            <div>
                <label class="block text-sm text-[#8b949e] mb-2">Foto Profil</label>
                <input type="file" name="foto" accept="image/*" class="input-dark text-sm">
            </div>

            <hr class="border-[#30363d]">

            <p class="text-sm text-[#8b949e] font-medium">Ubah Password (opsional)</p>

            <div>
                <label class="block text-sm text-[#8b949e] mb-2">Password Baru</label>
                <input type="password" name="password" autocomplete="new-password" class="input-dark" placeholder="Kosongkan jika tidak ingin mengubah">
                @error('password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm text-[#8b949e] mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" autocomplete="new-password" class="input-dark">
            </div>
        </div>

        <button type="submit" class="btn-gradient">Simpan Perubahan</button>
    </form>
</div>
@endsection