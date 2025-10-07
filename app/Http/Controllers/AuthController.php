<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('auth.login'); 
    }

    public function indexRegister()
    {
        return view('auth.registrasi'); 
    }
}
