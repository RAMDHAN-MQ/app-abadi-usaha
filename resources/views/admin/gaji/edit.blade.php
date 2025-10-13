@extends('layouts.admin')

@section('title', 'Edit Gaji')

@section('content')
<div class="container mt-4">
    <form action="{{ route('admin.gaji.update', $gaji->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- penting untuk update --}}

        <div class="mb-3">
            <label for="nama_petugas" class="form-label">Nama Petugas <span class="text-danger">*</span></label>
            <input type="text" id="nama_petugas" name="nama_petugas" class="form-control"
                value="{{ old('nama_petugas', $gaji->pekerja_relasi->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="status_gaji" class="form-label">Status Gaji <span class="text-danger">*</span></label>
            <input type="text" id="status_gaji" name="status_gaji" class="form-control"
                value="{{ old('status_gaji', $gaji->status) }}" required>
        </div>

        <div class="mb-3">
            <label for="pemesanan" class="form-label">Pemesanan <span class="text-danger">*</span></label>
            <textarea id="pemesanan" name="pemesanan" class="form-control" required>{{ old('pemesanan', $gaji->pemesanan_id) }}</textarea>
        </div>


        <button type="submit" class="btn btn-tambah">Simpan Perubahan</button>
        <a href="{{ route('admin.gaji') }}" class="btn btn-kembali">Kembali</a>
    </form>
</div>
@endsection
