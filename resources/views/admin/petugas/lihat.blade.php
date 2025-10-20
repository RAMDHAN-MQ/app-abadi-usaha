@extends('layouts.admin')

@section('title', 'Lihat Petugas')

@section('content')
<div class="container mt-4">
    <div class="">
        <table class="table table-bordered">
            <tr>
                <td style="width: 200px;">Nama Petugas</td>
                <td>{{ $petugas->name }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>{{ $petugas->status }}</td>
            </tr>
            <tr>
                <td>Job</td>
                <td>{{ $petugas->job }}</td>
            </tr>
            <tr>
                <td>No Rekening</td>
                <td>{{ $petugas->no_rekening }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $petugas->email }}</td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td><img src="{{ asset('storage/gambar_users/' . $petugas->gambar) }}" alt="Gambar" width="50%"></td>
            </tr>
        </table>
        <a href="{{ route('admin.petugas') }}" class="btn btn-kembali">Kembali</a>
    </div>
</div>
@endsection