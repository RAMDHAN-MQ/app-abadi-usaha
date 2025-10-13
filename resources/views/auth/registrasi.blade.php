@extends('layouts.master')

@section('title', 'Register Abadi Usaha')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100" style="background-color: #3C3B8B;">
    <div class="card shadow rounded-4 px-4 py-4" style="width: 420px; background-color: #e9e9e9;">
        <div class="text-center mb-3">
            {{-- Logo --}}
            <img src="{{ asset('storage/asset/logo.png') }}" alt="Logo" style="width: 50px; height: 50px;">
            <h4 class="fw-bold mt-2" style="color: #3C3B8B;">Registrasi</h4>
        </div>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div class="alert alert-success text-center py-2">{{ session('success') }}</div>
        @endif

        {{-- Notifikasi Error --}}
        @if ($errors->any())
            <div class="alert alert-danger py-2">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li class="small">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Register --}}
        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="mb-3">
                <input type="text" name="name" class="form-control form-control-lg rounded-pill fs-6" 
                       placeholder="Masukkan nama" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <input type="email" name="email" class="form-control form-control-lg rounded-pill fs-6" 
                       placeholder="Masukkan e-mail" value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <input type="text" name="alamat" class="form-control form-control-lg rounded-pill fs-6" 
                       placeholder="Masukkan alamat" value="{{ old('alamat') }}">
            </div>

            <div class="mb-3">
                <input type="text" name="no_telp" class="form-control form-control-lg rounded-pill fs-6" 
                       placeholder="Masukkan no tlpn" value="{{ old('no_telp') }}">
            </div>

            <div class="row mb-3">
                <div class="col">
                    <input type="password" name="password" class="form-control form-control-lg rounded-pill fs-6" 
                           placeholder="Password">
                </div>
                <div class="col">
                    <input type="password" name="password_confirmation" class="form-control form-control-lg rounded-pill fs-6" 
                           placeholder="Konfirmasi Password">
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn text-white rounded-pill py-2" style="background-color: #3C3B8B;">
                    Register
                </button>
            </div>
        </form>

        <div class="text-center mt-3">
            <small>Sudah Punya Akun? Klik 
                <a href="{{ route('login') }}" class="" style="color: #3C3B8B;">disini</a>
            </small>
        </div>
    </div>
</div>
@endsection
