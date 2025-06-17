<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;
    protected $table = 'permohonan';

    protected $fillable = [
        'id_rak',
        'id_klien',
        'id_pembayaran',
        'jenis_permohonan',
        'tanggal_pengajuan',
        'status_permohonan',
        'ktp',
        'kk',
        'npwp',
        'sertifikat_tanah',
        'sppt_pbb',
        'sspd_bphtb',
        'pph',
        'imb',
        'akta_nikah',
        'silsilah_waris',
        'pernyataan_hibah',
        'surat_pernyataan_waris',
        'akta_kematian',
        'akta_munita',
        'keterangan_permohonan'
    ];
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function rak()
    {
        return $this->belongsTo(Rak::class, 'id_rak');
    }
    public function klien()
    {
        return $this->belongsTo(Klien::class, 'id_klien');
    }
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_permohonan', 'id');
    }
}
