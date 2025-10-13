@extends('layouts.admin')

@section('title', 'Pegawai')

@section('content')
<div class="container-fluid mt-4 px-5">
    <h4 class="fw-bold mb-4">Daftar Petugas</h4>
    <div class="mb-3">
        <a href="{{ route('admin.layanan.create') }}" class="btn btn-tambah">
            <i class="bi bi-plus"></i> Tambah
        </a>
    </div>

    <table id="tabelPetugas" class="table table-bordered table-striped mt-3">
        <thead>
            <tr class="table-secondary">
                <th>No.</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Job</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($petugas as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->status }}</td>
                <td class="text-end"></td>
                <td class="text-center">
                    <form action="{{ route('admin.layanan.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('admin.layanan.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                        <button type="button" class="btn btn-danger btn-sm btn-delete"><i class="bi bi-trash"></i></button>
                        <a href="{{ route('admin.layanan.show', $item->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#tabelPetugas').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data ditemukan",
                "info": "Menampilkan _PAGE_ dari _PAGES_ halaman",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(difilter dari total _MAX_ data)"
            }
        });
    });
</script>
@endsection