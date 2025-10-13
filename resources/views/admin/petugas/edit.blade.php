@extends('layouts.admin')

@section('title', 'Edit Petugas')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-sm p-4 w-75" style="border-radius: 15px; background-color: #f9f9fc;">
        <h4 class="text-center mb-4 fw-bold text-uppercase" style="color: #3C3B8B;">Edit Data Petugas</h4>
        
        <form action="{{ route('admin.petugas.update', $petugas->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Petugas <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control"
                        placeholder="Masukkan nama petugas"
                        value="{{ old('name', $petugas->name) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="" disabled>Pilih status</option>
                        <option value="Sedia" {{ old('status', $petugas->status) == 'Sedia' ? 'selected' : '' }}>Sedia</option>
                        <option value="Tidak Sedia" {{ old('status', $petugas->status) == 'Tidak Sedia' ? 'selected' : '' }}>Tidak Sedia</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="job" class="form-label fw-semibold">Job <span class="text-danger">*</span></label>
                    <input type="text" id="job" name="job" class="form-control"
                        placeholder="Masukkan job"
                        value="{{ old('job', $petugas->job) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="no_rekening" class="form-label fw-semibold">No Rekening <span class="text-danger">*</span></label>
                    <input type="text" id="no_rekening" name="no_rekening" class="form-control"
                        placeholder="Masukkan nomor rekening"
                        value="{{ old('no_rekening', $petugas->no_rekening) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                    <input type="email" id="email" name="email" class="form-control"
                        placeholder="Masukkan email"
                        value="{{ old('email', $petugas->email) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label fw-semibold">Password (isi jika ingin ubah)</label>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Masukkan password baru (opsional)">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="gambar" class="form-label fw-semibold">Gambar</label>
                    <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*">
                    @if($petugas->gambar)
                        <small class="text-muted d-block mt-1">Gambar saat ini: {{ $petugas->gambar }}</small>
                        <img src="{{ asset('storage/gambar_users/' . $petugas->gambar) }}" 
                             alt="Gambar Petugas" 
                             width="100" 
                             class="mt-2 rounded shadow-sm border">
                    @endif
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn fw-bold text-white px-5 py-2 rounded-pill" 
                    style="background-color: #3C3B8B;">Simpan</button>
                <a href="{{ route('admin.petugas') }}" 
                    class="btn btn-secondary fw-bold px-4 py-2 rounded-pill ms-2">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
