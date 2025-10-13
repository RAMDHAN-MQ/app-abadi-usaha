@extends('layouts.admin')

@section('title', 'Edit Layanan')

@section('content')
<div class="container mt-4">
    <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- penting untuk update --}}

        <div class="mb-3">
            <label for="nama_layanan" class="form-label">Nama Layanan <span class="text-danger">*</span></label>
            <input type="text" id="nama_layanan" name="nama_layanan" class="form-control"
                value="{{ old('nama_layanan', $layanan->nama_layanan) }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga <span class="text-danger">*</span></label>
            <input type="number" id="harga" name="harga" class="form-control"
                value="{{ old('harga', $layanan->harga) }}" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
            <textarea id="keterangan" name="keterangan" class="form-control" required>{{ old('keterangan', $layanan->keterangan) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
            <input type="file" id="icon" name="icon" class="form-control" accept="image/*">
            @if($layanan->icon)
                <small class="d-block mt-2">Icon saat ini:</small>
                <img src="{{ asset('storage/icon_layanan/'.$layanan->icon) }}" alt="icon" width="50%">
            @endif
        </div>

        <button type="submit" class="btn btn-tambah">Simpan Perubahan</button>
        <a href="{{ route('admin.layanan') }}" class="btn btn-kembali">Kembali</a>
    </form>
</div>
@endsection
