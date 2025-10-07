@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
<div class="container mt-4">
    <div class="">
        <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_layanan" class="form-label">Nama Layanan <span class="text-danger">*</span></label>
                <input type="text" id="nama_layanan" name="nama_layanan" class="form-control" placeholder="Masukkan nama layanan" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga <span class="text-danger">*</span></label>
                <input type="number" id="harga" name="harga" class="form-control" placeholder="Masukkan harga" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Masukkan keterangan" required></textarea>
            </div>
            <div class="mb-3">
                <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                <input type="file" id="icon" name="icon" class="form-control" placeholder="Pilih icon" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-tambah">Simpan</button>
            <a href="{{ route('admin.layanan') }}" class="btn btn-kembali">Kembali</a>
        </form>
    </div>
</div>
@endsection