<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'slug', 'konten', 'gambar', 'status', 'tgl_publish',
    ];

    protected function casts(): array
    {
        return [
            'tgl_publish' => 'date',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'publish')->where('tgl_publish', '<=', now());
    }
}
