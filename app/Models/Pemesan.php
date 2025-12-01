<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesan extends Model
{
    use hasFactory;

    protected $table = 'pemesanan';

    protected $fillable = [
        'user_id',
        'nama_pemesan',
        'layanan_id',
        'no_telp',
        'alamat',
        'status',
        'harga',
        'total',
        'jarak_pipa',
        'updated_at',
        'created_at',
    ];

    public function layanan_relasi()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }

    public function detail_relasi()
    {
        return $this->hasMany(PemesananDetail::class, 'pemesanan_id');
    }

    public function gaji_relasi()
    {
        return $this->hasMany(Gaji::class, 'pemesanan_id');
    }

    public function testimoni_relasi()
    {
        return $this->hasMany(Testimoni::class, 'pemesanan_id');
    }

}
