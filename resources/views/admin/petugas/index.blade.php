@extends('layouts.admin')

@section('title', 'Pegawai')

@section('content')
<div class="container-fluid mt-4 px-5">
    <h4 class="fw-bold mb-4">Daftar Petugas</h4>
    <div class="mb-3">
        <a href="{{ route('admin.petugas.create') }}" class="btn btn-tambah">
            <i class="bi bi-plus"></i> Tambah
        </a>
    </div>

    <table id="tabelPetugas" class="table table-bordered table-striped mt-3 align-middle">
    <thead>
        <tr class="table-secondary text-center">
            <th style="width: 5%;">No.</th>
            <th class="text-start">Nama</th>
            <th class="text-center">Status</th>
            <th class="text-end">Job</th>
            <th class="text-end">No Rekening</th>
            <th class="text-end">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($petugas as $item)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td class="text-start">{{ $item->name }}</td>
            <td class="text-center">{{ $item->status }}</td>
            <td class="text-end">{{ $item->job }}</td>
            <td class="text-end">{{ $item->no_rekening }}</td>
            <td class="text-end">
                <form action="{{ route('admin.petugas.delete', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('admin.petugas.edit', $item->id) }}" class="btn btn-warning btn-sm me-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="submit" class="btn btn-danger btn-sm me-1" onclick="return confirm('Yakin ingin menghapus data ini?')">
                        <i class="bi bi-trash"></i>
                    </button>
                    <a href="{{ route('admin.petugas.show', $item->id) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-eye"></i>
                    </a>
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