<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function beranda()
    {
        $testimoni = Testimoni::orderBy('created_at', 'desc')->take(6)->get();
        
        return view('pemesan.beranda', compact('testimoni'));
    }
}
