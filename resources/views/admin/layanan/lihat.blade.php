@extends('layouts.admin')

@section('title', 'Lihat Layanan')

@section('content')
<div class="container mt-4">
    <div class="">
        <table class="table table-bordered">
            <tr>
                <td style="width: 200px;">Nama Layanan</td>
                <td>{{ $layanan->nama_layanan }}</td>
            </tr>
            <tr>
                <td>Harga</td>
                <td>Rp{{ number_format($layanan->harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>{{ $layanan->keterangan }}</td>
            </tr>
            <tr>
                <td>Icon</td>
                <td><img src="{{ asset('storage/icon_layanan/' . $layanan->icon) }}" alt="Icon" width="500"></td>
            </tr>
        </table>
        <a href="{{ route('admin.layanan') }}" class="btn btn-kembali">Kembali</a>
    </div>
</div>
@endsection