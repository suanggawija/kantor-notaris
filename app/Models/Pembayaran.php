<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';

    protected $fillable = [
        'tgl_pembayaran',
        'total_pembayaran',
        'id_permohonan'
    ];

    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class, 'id_permohonan');
    }
}
