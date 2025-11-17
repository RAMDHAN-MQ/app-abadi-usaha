@extends('layouts.admin')

@section('title', 'Gaji')

@section('content')

<div class="container-fluid mt-4 px-5">
    <h4 class="fw-bold mb-4">Daftar Gaji</h4>

    <table id="tabelGaji" class="table table-bordered table-striped mt-3 align-middle">
        <thead>
            <tr class="table-secondary text-center">
                <th>No.</th>
                <th>Pekerja</th>
                <th>No.Rek</th>
                <th>Periode</th>
                <th>Gaji Karyawan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($gaji as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pekerja_relasi->name ?? '-' }}</td>
                    <td>{{ $item->pekerja_relasi->no_rekening ?? '-' }}</td>

                    <td>
                        {{ date('d M Y', strtotime($item->periode_start)) }}
                        -
                        {{ date('d M Y', strtotime($item->periode_end)) }}
                    </td>

                    <td>Rp {{ number_format($item->totalKaryawan, 0, ',', '.') }}</td>

                    <td>
                        <span class="badge bg-{{ $item->status == 'Lunas' ? 'success' : 'danger' }}">
                            {{ $item->status }}
                        </span>
                    </td>

                    <td>
                        @if($item->status === 'Belum Lunas')
                            <form action="{{ route('admin.gaji.bayar', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-success btn-sm">
                                    <i class="fa fa-money-bill"></i> Bayar
                                </button>
                            </form>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>
                                Sudah Dibayar
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data gaji mingguan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

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
</script>
@endsection
