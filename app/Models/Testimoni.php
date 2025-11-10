<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimoni extends Model
{
    use hasFactory;

    protected $table = 'testimoni';

    protected $fillable = [
        'id',
        'user_id',
        'pemesanan_id',
        'komentar',
        'rating',
        'updated_at',
        'created_at',
    ];

    public function testimoni_pemesanan_relasi()
    {
        return $this->belongsTo(Pemesan::class, 'pemesanan_id');
    }

    public function user_relasi()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}
