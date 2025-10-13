@extends('layouts.admin')

@section('title', 'Tambah Petugas')

@section('content')
<div class="container mt-4">
    <div class="">
        <form action="{{ route('admin.petugas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_petugas" class="form-label">Nama <span class="text-danger">*</span></label>
                <input type="text" id="nama_petugas" name="nama_petugas" class="form-control" placeholder="Masukkan nama petugas" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <input type="text" id="status" name="status" class="form-control" placeholder="Masukkan status" required>
            </div>
            <div class="mb-3">
                <label for="job" class="form-label">Job <span class="text-danger">*</span></label>
                <textarea id="job" name="job" class="form-control" placeholder="Masukkan job" required></textarea>
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