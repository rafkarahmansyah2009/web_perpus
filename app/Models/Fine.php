<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id', 'jumlah_hari', 'nominal_denda', 'status_bayar', 'tgl_bayar',
    ];

    protected function casts(): array
    {
        return [
            'tgl_bayar' => 'date',
        ];
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
