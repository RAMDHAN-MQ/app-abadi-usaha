<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layanan extends Model
{
    use hasFactory;

    protected $table = 'layanan';

    protected $fillable = [
        'nama_layanan',
        'harga',
        'keterangan',
        'icon',
        'updated_at',
        'created_at',
    ];

    public function pemesan_relasi()
    {
        return $this->hasMany(Pemesan::class, 'layanan_id');
    }
}
