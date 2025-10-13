@extends('layouts.admin')

@section('title', 'Edit Pemesanan')

@section('content')
<div class="container mt-4">
    <form action="{{ route('admin.pemesanan.update', $pemesanan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- penting untuk update --}}

        <div class="mb-3">
            <label for="nama_pemesanan" class="form-label">Nama Pemesan <span class="text-danger">*</span></label>
            <input type="text" id="nama_pemesanan" name="nama_pemesanan" class="form-control"
                value="{{ old('nama_pemesan', $pemesanan->nama_pemesan) }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
            <input type="text" id="alamat" name="alamat" class="form-control"
                value="{{ old('alamat', $pemesanan->alamat) }}" required>
        </div>
        <div class="mb-3">
            <label for="nomor_hp" class="form-label">Nomor HP <span class="text-danger">*</span></label>
            <input id="nomor_hp" name="nomor_hp" class="form-control" value="{{ old('nomor_hp', $pemesanan->no_telp) }}" required></input>
        </div>

        <div class="mb-3">
            <label for="jenis_layanan" class="form-label">Jenis Layanan <span class="text-danger">*</span></label>
            <select name="" id=""></select>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga <span class="text-danger">*</span></label>
            <input id="harga" name="harga" class="form-control" value="{{ old('harga', $pemesanan->harga) }}" required>
        </div>

        <button type="submit" class="btn btn-tambah">Simpan Perubahan</button>
        <a href="{{ route('admin.pemesanan') }}" class="btn btn-kembali">Kembali</a>
    </form>
</div>
@endsection
