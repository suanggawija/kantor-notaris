<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
    use HasFactory;
    protected $table = 'klien';

    protected $fillable = [
        'nik_klien',
        'nama_klien',
        'email_klien',
        'no_telp_klien',
        'alamat_klien',

    ];
}
