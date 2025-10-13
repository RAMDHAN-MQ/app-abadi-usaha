@extends('layouts.admin')

@section('title', 'Lihat Gaji')

@section('content')
<div class="container mt-4">
    <div class="">
        <table class="table table-bordered">
            <tr>
                <td style="width: 200px;">Nama Petugas</td>
                <td>{{ $gaji->pekerja_relasi->name }}</td>
            </tr>
            <tr>
                <td style="width: 200px;">Status Gaji</td>
                <td>{{ $gaji->status }}</td>
            </tr>
            <tr>
                <td style="width: 200px;">Pemesanan </td>
                <td><a href="{{ route('admin.pemesanan.show',$gaji->pemesanan_id) }}">Lihat Detail Pemesanan</a></td>
            </tr>

        </table>
        <a href="{{ route('admin.gaji') }}" class="btn btn-kembali">Kembali</a>
    </div>
</div>
@endsection