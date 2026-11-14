@extends('layouts.admin')
@section('title', 'Tambah Buku')
@section('breadcrumb', 'Buku / Tambah')

@section('content')
<div class="max-w-3xl">
    <h1 class="text-2xl font-bold font-['Space_Grotesk'] mb-6">Tambah Buku Baru</h1>
    <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-dark p-6 space-y-5 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm text-[#8b949e] mb-2">Judul *</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required class="input-dark">
                    @error('judul')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm text-[#8b949e] mb-2">ISBN</label>
                    <input type="text" name="isbn" value="{{ old('isbn') }}" class="input-dark">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm text-[#8b949e] mb-2">Pengarang *</label>
                    <input type="text" name="pengarang" value="{{ old('pengarang') }}" required class="input-dark">
                </div>
                <div>
                    <label class="block text-sm text-[#8b949e] mb-2">Penerbit</label>
                    <input type="text" name="penerbit" value="{{ old('penerbit') }}" class="input-dark">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm text-[#8b949e] mb-2">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit') }}" class="input-dark">
                </div>
                <div>
                    <label class="block text-sm text-[#8b949e] mb-2">Kategori *</label>
                    <select name="kategori_id" required class="input-dark">
                        <option value="">Pilih</option>
                        @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ old('kategori_id')==$c->id?'selected':'' }}>{{ $c->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-[#8b949e] mb-2">Stok *</label>
                    <input type="number" name="stok" value="{{ old('stok',1) }}" min="0" required class="input-dark">
                </div>
            </div>
            <div>
                <label class="block text-sm text-[#8b949e] mb-2">Lokasi Rak</label>
                <input type="text" name="lokasi_rak" value="{{ old('lokasi_rak') }}" class="input-dark">
            </div>
            <div>
                <label class="block text-sm text-[#8b949e] mb-2">Cover</label>
                <div id="cover-preview-container" class="hidden mb-3">
                    <img id="cover-preview" src="#" alt="Preview Cover" class="w-24 h-36 object-cover rounded-xl border border-[#30363d] shadow-md">
                </div>
                <input type="file" name="cover" id="cover-input" accept="image/*" class="input-dark text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-500/10 file:text-blue-400 hover:file:bg-blue-500/20">
            </div>
            <div>
                <label class="block text-sm text-[#8b949e] mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="input-dark">{{ old('deskripsi') }}</textarea>
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="btn-gradient">Simpan</button>
            <a href="{{ route('admin.buku.index') }}" class="px-6 py-2.5 border border-[#30363d] rounded-xl text-sm hover:bg-[#1c2128]">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    const coverInput = document.getElementById('cover-input');
    const previewContainer = document.getElementById('cover-preview-container');
    const previewImg = document.getElementById('cover-preview');

    if (coverInput) {
        coverInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImg.src = event.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endpush
