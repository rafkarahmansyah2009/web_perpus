@extends('layouts.admin')
@section('title', 'Edit Buku')
@section('breadcrumb', 'Buku / Edit')

@section('content')
<div class="max-w-3xl">
    <h1 class="text-2xl font-bold font-['Space_Grotesk'] mb-6">Edit Buku</h1>
    <form action="{{ route('admin.buku.update', $buku) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="card-dark p-6 space-y-5 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm text-[#8b949e] mb-2">Judul *</label>
                    <input type="text" name="judul" value="{{ old('judul', $buku->judul) }}" required class="input-dark">
                </div>
                <div>
                    <label class="block text-sm text-[#8b949e] mb-2">ISBN</label>
                    <input type="text" name="isbn" value="{{ old('isbn', $buku->isbn) }}" class="input-dark">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm text-[#8b949e] mb-2">Pengarang *</label>
                    <input type="text" name="pengarang" value="{{ old('pengarang', $buku->pengarang) }}" required class="input-dark">
                </div>
                <div>
                    <label class="block text-sm text-[#8b949e] mb-2">Penerbit</label>
                    <input type="text" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" class="input-dark">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm text-[#8b949e] mb-2">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" class="input-dark">
                </div>
                <div>
                    <label class="block text-sm text-[#8b949e] mb-2">Kategori *</label>
                    <select name="kategori_id" required class="input-dark">
                        @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ old('kategori_id', $buku->kategori_id)==$c->id?'selected':'' }}>{{ $c->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-[#8b949e] mb-2">Stok *</label>
                    <input type="number" name="stok" value="{{ old('stok', $buku->stok) }}" min="0" required class="input-dark">
                </div>
            </div>
            <div>
                <label class="block text-sm text-[#8b949e] mb-2">Lokasi Rak</label>
                <input type="text" name="lokasi_rak" value="{{ old('lokasi_rak', $buku->lokasi_rak) }}" class="input-dark">
            </div>
            <div>
                <label class="block text-sm text-[#8b949e] mb-2">Cover</label>
                <div class="mb-3">
                    @if($buku->cover)
                        <img id="cover-preview" src="{{ asset('storage/'.$buku->cover) }}" class="w-24 h-36 object-cover rounded-xl border border-[#30363d] shadow-md">
                    @else
                        <div id="cover-preview-container" class="hidden">
                            <img id="cover-preview" src="#" alt="Preview Cover" class="w-24 h-36 object-cover rounded-xl border border-[#30363d] shadow-md">
                        </div>
                    @endif
                </div>
                <input type="file" name="cover" id="cover-input" accept="image/*" class="input-dark text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-500/10 file:text-blue-400 hover:file:bg-blue-500/20">
                <p class="text-xs text-[#8b949e] mt-1.5">Pilih file baru jika ingin mengganti cover saat ini.</p>
            </div>
            <div>
                <label class="block text-sm text-[#8b949e] mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="input-dark">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="btn-gradient">Simpan Perubahan</button>
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
                    if (previewContainer) {
                        previewContainer.classList.remove('hidden');
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endpush
