@extends('layouts.master')

@section('title', 'Login Abadi Usaha')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100" style="background-color: #3C3B8B;">
    <div class="card shadow rounded-4 px-4 py-4" style="width: 380px; background-color: #e9e9e9;">
        <div class="text-center mb-3">
            {{-- Logo --}}
            <img src="{{ asset('storage/asset/logo.png') }}" alt="Logo" style="width: 50px; height: 50px;">
            <h4 class="fw-bold mt-2">Login</h4>
        </div>

        {{-- Form Login --}}
        <form>
            <div class="mb-3">
                <input type="text" class="form-control form-control-lg rounded-pill fs-6" placeholder="e-mail">
            </div>

            <div class="mb-3">
                <input type="password" class="form-control form-control-lg rounded-pill fs-6" placeholder="password">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn text-white rounded-pill py-2" style="background-color: #3C3B8B;">
                    Login
                </button>
            </div>
        </form>

        <div class="text-center mt-3">
            <small>Belum Punya Akun? Klik <a href="/registrasi"  style="color: #3C3B8B;">disini</a></small>
        </div>
    </div>
</div>
@endsection
