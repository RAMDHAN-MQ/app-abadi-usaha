@extends('layouts.admin')

@section('title', 'Gaji')

@section('content')
<div class="container-fluid mt-4 px-5">
    <h4 class="fw-bold mb-4">Daftar Gaji</h4>

    <table id="tabelGaji" class="table table-bordered table-striped mt-3">
        <thead>
            <tr class="table-secondary">
                <th>No.</th>
                <th>Nama Petugas</th>
                <th>Status Gaji</th>
                <th>Gaji</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gaji as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->pekerja_relasi->name }}</td>
                <td>
                    @if( $item->status == 'Belum Lunas' )
                        <span class="badge bg-danger">{{ $item->status }}</span>
                    @else
                        <span class="badge bg-success">{{ $item->status }}</span>
                    @endif
                </td>
                <td class="text-end">Rp{{ number_format($item->gaji_karyawan, 0, ',', '.') }}</td>
                <td class="text-end">{{ $item->created_at }}</td>
                <td class="text-center">
                    <form action="{{ route('admin.gaji.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-warning btn-sm btn-detail" data-bs-toggle="modal" data-bs-target="#gajiModal" data-nama="{{ $item->pekerja_relasi->name }}"
                            data-norek="{{ $item->pekerja_relasi->no_rekening ?? '-' }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm btn-delete"><i class="bi bi-trash"></i></button>
                        <a href="{{ route('admin.gaji.show', $item->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                    </form>
                    @if($item->status != 'Lunas')
                        <form action="{{ route('admin.gaji.updateGaji', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-check"></i></button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

<div class="modal fade" id="gajiModal" tabindex="-1" aria-labelledby="gajiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="gajiModalLabel">Detail Pekerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


@section('script')
<script>
    $(document).ready(function() {
        $('#tabelGaji').DataTable({
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

    $(document).on('click', '.btn-detail', function() {
        const nama = $(this).data('nama');
        const norek = $(this).data('norek');

        $('#gajiModal .modal-body').html(`
                <p><strong>Nama Petugas:</strong> ${nama}</p>
                <p><strong>No. Rekening:</strong> ${norek}</p>
            `);
    });
</script>
@endsection