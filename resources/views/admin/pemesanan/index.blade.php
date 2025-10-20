@extends('layouts.admin')

@section('title', 'Pemesanan')

@section('content')
<div class="container-fluid mt-4 px-5">
    <h4 class="fw-bold mb-4">Daftar Pemesanan</h4>
    <div class="mb-3">
        <a href="{{ route('admin.pemesanan.create') }}" class="btn btn-tambah">
            <i class="bi bi-plus"></i> Tambah
        </a>
    </div>

    <table id="tabelPemesanan" class="table table-bordered table-striped mt-3">
        <thead>
            <tr class="table-secondary">
                <th>No.</th>
                <th>Nama Pemesan</th>
                <th>Lokasi</th>
                <th>Jenis Layanan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemesan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_pemesan }}</td>
                <td class="text-ellipsis">{{ $item->alamat }}</td>
                <td>{{ $item->layanan_relasi->nama_layanan }}</td>
                <td>
                    @if ($item->status == 'selesai')
                    <span class="badge bg-success">{{ $item->status }}</span>
                    @elseif ($item->status == 'proses')
                    <span class="badge bg-warning text-dark">{{ $item->status }}</span>
                    @else
                    <span class="badge bg-secondary">{{ $item->status }}</span>
                    @endif
                </td>

                <td class="text-center">
                    <form action="{{ route('admin.pemesanan.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('admin.pemesanan.edit', $item->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm btn-delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>

                    <a href="{{ route('admin.pemesanan.show', $item->id) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-eye"></i>
                    </a>

                    @if($item->status == 'pending')
                        <button type="button" 
                            class="btn btn-success btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#pilihPetugas" 
                            data-id="{{ $item->id }}">
                            <i class="bi bi-person-fill-up"></i>
                        </button>
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

<div class="modal fade" id="pilihPetugas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form action="{{ route('admin.pemesanan.kirimPetugas') }}" method="POST">
            @csrf
            <input type="hidden" name="pemesanan_id" id="pemesanan_id_modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Petugas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Petugas 1</label>
                        <select name="petugas1" id="petugas1" class="form-select">
                            <option value="" selected disabled>Pilih Pekerja</option>
                            @foreach($petugas as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->job }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Petugas 2</label>
                        <select name="petugas2" id="petugas2" class="form-select">
                            <option value="" selected disabled>Pilih Pekerja</option>
                            @foreach($petugas as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->job }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Petugas 3</label>
                        <select name="petugas3" id="petugas3" class="form-select">
                            <option value="" selected disabled>Pilih Pekerja</option>
                            @foreach($petugas as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->job }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </div>
        </form>

    </div>
</div>

@section('script')
<script>
    $(document).ready(function() {
        $('#tabelPemesanan').DataTable({
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _PAGE_ dari _PAGES_ halaman",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(difilter dari total _MAX_ data)"
            }
        });

        // Ketika modal dibuka
        const modalPetugas = document.getElementById('pilihPetugas');
        modalPetugas.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const pemesananId = button.getAttribute('data-id');
            document.getElementById('pemesanan_id_modal').value = pemesananId;
        });
    });
</script>
@endsection
