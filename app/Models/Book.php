<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'isbn', 'judul', 'pengarang', 'penerbit', 'tahun_terbit',
        'kategori_id', 'deskripsi', 'cover', 'stok', 'lokasi_rak',
    ];

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function loans()
    {
        return $this->hasMany(Loan::class, 'book_id');
    }

    public function tersedia(): bool
    {
        $dipinjam = $this->loans()->whereIn('status', ['pending', 'dipinjam', 'terlambat'])->count();
        return ($this->stok - $dipinjam) > 0;
    }

    public function stokTersedia(): int
    {
        $dipinjam = $this->loans()->whereIn('status', ['pending', 'dipinjam', 'terlambat'])->count();
        return max(0, $this->stok - $dipinjam);
    }
}
