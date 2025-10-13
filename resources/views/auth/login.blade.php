@extends('layouts.master')
@section('title', 'Login Abadi Usaha')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100" style="background-color: #3C3B8B;">
    <div class="card shadow rounded-4 px-4 py-4" style="width: 380px; background-color: #e9e9e9;">
        <div class="text-center mb-3">
            {{-- Logo --}}
            <img src="{{ asset('storage/asset/logo.png') }}" alt="Logo" style="width: 50px; height: 50px;">
            <h4 class="fw-bold mt-2" style="color: #3C3B8B;">Login</h4>
        </div>

        {{-- Pesan Sukses --}}
        @if (session('success'))
            <div class="alert alert-success text-center py-2">{{ session('success') }}</div>
        @endif

        {{-- Pesan Error --}}
        @if (session('error'))
            <div class="alert alert-danger text-center py-2">{{ session('error') }}</div>
        @endif

        {{-- Validasi Error --}}
        @if ($errors->any())
            <div class="alert alert-danger py-2">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Login --}}
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control form-control-lg rounded-pill fs-6" 
                       placeholder="Masukkan email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control form-control-lg rounded-pill fs-6" 
                       placeholder="Masukkan password" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn text-white rounded-pill py-2" style="background-color: #3C3B8B;">
                    Login
                </button>
            </div>
        </form>

        <div class="text-center mt-3">
            <small>Belum Punya Akun? Klik 
                <a href="{{ route('register') }}" style="color: #3C3B8B;">disini</a>
            </small>
        </div>
    </div>
</div>
@endsection
