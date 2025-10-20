@extends('layouts.admin')

@section('title', 'Lihat Pemesanan')

@section('content')
<div class="container mt-4">
    <div class="">
        <table class="table table-bordered">
            <tr>
                <td style="width: 200px;">Nama Pemesan</td>
                <td>{{ $pemesanan->nama_pemesan }}</td>
            </tr>

            <tr>
                <td>Alamat</td>
                <td>{{ $pemesanan->alamat }}</td>
            </tr>
            <tr>
                <td>Nomor HP</td>
                <td>{{ $pemesanan->no_telp }}</td>
            </tr>
            <tr>
                <td>Jenis Layanan</td>
                <td>{{ $pemesanan->layanan_relasi->nama_layanan }}</td>
            </tr>
            <tr>
                <td>Harga</td>
                <td>Rp{{ number_format($pemesanan->harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Pekerja</td>
                <td>
                    @forelse($pekerja as $item)
                    • {{ $item->pekerja_relasi->name }} - {{ $item->pekerja_relasi->job }}<br>
                    @empty
                    <span class="badge bg-danger">Belum memilih petugas</span>
                    @endforelse
                </td>
            </tr>

        </table>
        <a href="{{ route('admin.pemesanan') }}" class="btn btn-kembali">Kembali</a>
    </div>
</div>
@endsection