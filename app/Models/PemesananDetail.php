<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananDetail extends Model
{
    use hasFactory;

    protected $table = 'detail_pemesanan';
    public $timestamps = false;

    protected $fillable = [
        'pemesanan_id',
        'pekerja_id',
        'verifikasi',
        'alasan',
    ];

    public function detail_pemesanan_relasi()
    {
        return $this->belongsTo(Pemesan::class, 'pemesanan_id');
    }

    public function pekerja_relasi()
    {
        return $this->belongsTo(Users::class, 'pekerja_id');
    }
}
