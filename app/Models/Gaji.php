<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gaji extends Model
{
    use hasfactory;

    protected $table = 'gaji';

    protected $fillable = [
        'user_id',
        'pemesanan_id',
        'totalKaryawan',
        'periode_start',
        'periode_end',
        'status',
        'updated_at',
        'created_at',
    ];

    public function pekerja_relasi()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function pemesanan_relasi()
    {
        return $this->belongsTo(Pemesan::class, 'pemesanan_id');
    }
}
