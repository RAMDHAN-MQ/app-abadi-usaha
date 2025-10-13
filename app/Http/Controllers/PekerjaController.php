<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class PekerjaController extends Controller
{
    public function index()
    {
        $petugas = Users::all();
        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }
}
