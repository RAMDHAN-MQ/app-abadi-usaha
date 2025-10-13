@extends('layouts.admin')

@section('title', 'Tambah Petugas')

@section('content')
<div class="container mt-4">
    <div class="">
        <form action="{{ route('admin.petugas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Petugas <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama petugas" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select id="status" name="status" class="form-select" required>
                    <option value="" selected disabled>Pilih status</option>
                    <option value="Sedia">Sedia</option>
                    <option value="Tidak Sedia">Tidak Sedia</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="job" class="form-label">Job <span class="text-danger">*</span></label>
                <input id="job" name="job" class="form-control" placeholder="Masukkan job" required></input>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input id="email" name="email" class="form-control" placeholder="Masukkan email" required></input>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input id="password" name="password" class="form-control" placeholder="Masukkan password" required></input>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar <span class="text-danger">*</span></label>
                <input type="file" id="gambar" name="gambar" class="form-control" placeholder="Pilih gambar" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-tambah">Simpan</button>
            <a href="{{ route('admin.petugas') }}" class="btn btn-kembali">Kembali</a>
        </form>
    </div>
</div>
@endsection