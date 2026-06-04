<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Kategori;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'user_id',
        'kategori',
        'judul',
        'deskripsi',
        'lokasi',
        'waktu',
        'bukti',
        'status',
        'tanggapan'
    ];

    // RELASI USER
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // RELASI KATEGORI
    public function kategoriData()
    {
        return $this->belongsTo(Kategori::class, 'kategori', 'id_kategori');
    }
}