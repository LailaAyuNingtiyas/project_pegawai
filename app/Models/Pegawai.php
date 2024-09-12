<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';
    // Kolom yang bisa diisi melalui form
    protected $fillable = [
        'nama',
        'email',
        'tanggal_lahir',
        'jabatan',
        'file'
    ];
}

