<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abadi Usaha</title>

    <!-- Import Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Import Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #2D2F48;
            scroll-behavior: smooth;
        }

        .bg-primary-custom {
            background-color: #1C1E53 !important;
        }

        .bg-light-custom {
            background-color: #EEF3FF !important;
        }

        .text-primary-custom {
            color: #1C1E53 !important;
        }

        .btn-primary-custom {
            background-color: #1C1E53 !important;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: #313473 !important;
            transform: translateY(-3px);
        }

        .btn-light:hover {
            background-color: #fff !important;
            transform: translateY(-3px);
        }

        .card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 1rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        section {
            padding: 80px 0;
        }

        footer a {
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        footer a:hover {
            color: #FFD700;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg bg-primary-custom navbar-dark py-3 sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">Abadi Usaha</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-3">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#mengapa">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                    <li class="nav-item"><a class="btn btn-light text-primary-custom ms-lg-3 px-3 fw-semibold" href="login">Masuk</a></li>
                    <li class="nav-item"><a class="nav-link" href="registrasi">Daftar</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ===== HERO ===== -->
    <section id="beranda" class="bg-primary-custom text-white">
        <div class="container py-5">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6">
                    <h1 class="fw-bold display-5 mb-3">Membantu Melancarkan<br>Saluran WC</h1>
                    <p class="lead mb-4">Abadi Usaha hadir untuk melayani sedot WC, pelancaran saluran, dan perawatan sanitasi rumah Anda.</p>
                    <a href="{{ route('form-pesan') }}" class="btn btn-light text-primary-custom fw-semibold px-4 py-2 rounded-pill">Pesan Sekarang</a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('storage/asset/org_sedot.png') }}" alt="Petugas Sedot WC" class="img-fluid" style="max-width: 380px;">
                </div>
            </div>
        </div>
    </section>

    <!-- ===== LAYANAN ===== -->
    <section id="layanan" class="bg-light-custom text-center">
        <div class="container">
            <h2 class="fw-bold mb-5 text-primary-custom">Layanan Kami</h2>
            <div class="row justify-content-center g-4">
                <div class="col-md-4">
                    <div class="card py-5 shadow-sm" style="height: 500px;">
                        <div class="card-body">
                            <h5 class="fw-bold text-primary-custom">Sedot WC</h5>
                            <p class="text-muted mt-3">Layanan cepat, bersih, dan profesional untuk kebutuhan sanitasi Anda.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card py-5 shadow-sm" style="height: 500px;">
                        <div class="card-body">
                            <h5 class="fw-bold text-primary-custom">Pelancaran</h5>
                            <p class="text-muted mt-3">Atasi saluran mampet dengan tenaga berpengalaman kami.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== MENGAPA HARUS MEMILIH KAMI ===== -->
    <section id="mengapa" class="bg-primary-custom text-white text-center" >
        <div class="container">
            <h2 class="fw-bold mb-5">Mengapa Harus Memilih Kami</h2>
            <div class="row g-4">
                @for ($i = 1; $i <= 6; $i++)
                    <div class="col-md-4">
                    <div class="card bg-light text-primary-custom py-5">
                        <div class="card-body fw-semibold" style="height: 150px;">Keunggulan {{ $i }}</div>
                    </div>
            </div>
            @endfor
        </div>
        </div>
    </section>

    <!-- ===== TESTIMONI ===== -->
    <section id="testimoni" class="bg-light-custom text-center">
        <div class="container">
            <h2 class="fw-bold mb-5 text-primary-custom">Testimoni</h2>
            <div class="row g-4">
                @for ($i = 1; $i <= 6; $i++)
                    <div class="col-md-4">
                    <div class="card shadow-sm p-4" >
                        <p class="fst-italic mb-3" >"Pelayanan cepat, sopan, dan hasilnya memuaskan."</p>
                        <h6 class="fw-bold mb-0">Pelanggan {{ $i }}</h6>
                    </div>
            </div>
            @endfor
        </div>
        </div>
    </section>

    <!-- ===== KONTAK ===== -->
    <section id="kontak" class="bg-primary-custom text-white">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-3">Butuh Konsultasi..?</h2>
                    <p class="mb-4">Silakan hubungi kami, tim kami siap membantu Anda.</p>
                    <ul class="list-unstyled lh-lg">
                        <li>📍 Jl. Imam Bonjol No. 68, Ngadirejo, Kediri</li>
                        <li>📞 0812-5225-8526</li>
                        <li>📧 abadiusaha@gmail.com</li>
                    </ul>
                    <div class="mt-3">
                        <a href="https://youtube.com/shorts/bS6m7fex4bI?si=Y7O0Y9oAEpyvqh85" class="btn btn-light text-primary-custom me-2 px-3">Facebook</a>
                        <a href="https://youtu.be/Rp32iknA0a4?si=I66j-ExmBZdCSsvy" class="btn btn-light text-primary-custom px-3">Instagram</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('storage/asset/truk.png') }}" alt="Truk Sedot WC" class="img-fluid" style="max-width: 380px;">
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-dark text-white text-center py-4">
        <p class="mb-0">© 2025 Abadi Usaha</p>
        <div class="small mt-2">
            <a href="#beranda" class="me-2">Beranda</a> |
            <a href="#layanan" class="mx-2">Layanan</a> |
            <a href="#mengapa" class="mx-2">Tentang</a> |
            <a href="#kontak" class="mx-2">Kontak</a> |
            <a href="#" class="ms-2">Masuk</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>