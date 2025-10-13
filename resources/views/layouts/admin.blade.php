<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            font-size: large;
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .sidebar {
            width: 250px;
            background: #313473;
            color: #fff;
            padding-top: 20px;
            font-weight: 600;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            margin: 7px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #fff;
            color: #313473;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .sidebar .icon {
            width: 24px;
            text-align: center;
            font-size: 18px;
        }

        .content {
            flex: 1;
            padding: 20px;
            background: #f5f6fa;
        }

        .btn-tambah {
            background-color: #313473;
            color: white;
        }

        .btn-tambah:hover {
            background-color: #1f202eff;
            color: white;
        }

        .btn-kembali {
            background-color: #D9D9D9;
            color: black;
        }

        .btn-kembali:hover {
            background-color: #888888ff;
            color: white;
        }

        th {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="text-center">
            <h5 class="fw-bold mb-2">ABADI USAHA</h5>
            <hr style="border: 1px solid #ffffff; opacity: 0.6; margin: 0 0px;">
        </div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="icon">🗂</span><span>Dashboard</span>
        </a>
        <a href="#" class="{{ request()->routeIs('admin.pemesanan*') ? 'active' : '' }}">
            <span class="icon">📧</span><span>Pemesanan</span>
        </a>
        <a href="{{ route('admin.layanan') }}" class="{{ request()->routeIs('admin.layanan*') ? 'active' : '' }}">
            <span class="icon">⚙</span><span>Kelola Layanan</span>
        </a>
        <a href="{{ route('admin.petugas') }}" class="{{ request()->routeIs('admin.petugas*') ? 'active' : '' }}">
            <span class="icon">👷‍♂️</span><span>Kelola Petugas</span>
        </a>
        <a href="#" class="{{ request()->routeIs('admin.gaji*') ? 'active' : '' }}">
            <span class="icon">💸</span><span>Kelola Gaji</span>
        </a>
        <hr style="border: 1px solid #ffffff; opacity: 0.6; margin: 0 0px;">
        <a href="#">
            <span class="icon">🚪</span><span>Logout</span>
        </a>
    </div>


    <div class="content">
        @yield('content')
    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#102c84',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data ini akan dihapus!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    @yield('script')
</body>

</html>