@extends('layouts.admin')

@section('title', 'Tambah Pemesanan')

@section('content')
<div class="container mt-4">
    <div class="">
        <form action="{{ route('admin.pemesanan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_pemesan" class="form-label">Nama Pemesan <span class="text-danger">*</span></label>
                <input type="text" id="nama_pemesan" name="nama_pemesan" class="form-control" placeholder="Masukkan nama pemesanan" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukkan alamat" required>
            </div>
            <div class="mb-3">
                <label for="no_telp" class="form-label">Nomor HP <span class="text-danger">*</span></label>
                <input type="number" id="no_telp" name="no_telp" class="form-control" placeholder="08.." required>
            </div>
            <div class="mb-3">
                <label for="jenis_layanan" class="form-label">Jenis Layanan <span class="text-danger">*</span></label>
                <select name="layanan" id="layanan" class="form-select">
                    <option value="" selected disabled>Pilih Layanan</option>
                    @foreach($layanan as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_layanan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga <span class="text-danger">*</span></label>
                <input type="number" id="harga" name="harga" class="form-control" placeholder="Masukkan harga" required>
            </div>

            <button type="submit" class="btn btn-tambah">Simpan</button>
            <a href="{{ route('admin.pemesanan') }}" class="btn btn-kembali">Kembali</a>
        </form>
    </div>
</div>
@endsection