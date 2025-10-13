<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Users extends Model
{
    use hasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'job',
        'gambar',
        'no_telp',
        'created_at',
        'updated_at',
    ];

    public function gaji_relasi()
    {
        return $this->hasMany(Gaji::class, 'user_id');
    }
}
