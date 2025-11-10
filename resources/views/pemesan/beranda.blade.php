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

        .text-truncate-multiline {
            display: -webkit-box;
            -webkit-line-clamp: 3; /* ubah angka ini untuk jumlah baris yang ditampilkan */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }
    </style>
</head>

<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg bg-primary-custom navbar-dark py-3 sticky-top shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <a class="navbar-brand fw-bold fs-4" href="#">Abadi Usaha</a>

        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Tengah -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav text-center gap-3">
                <li class="nav-item"><a class="nav-link fw-semibold text-white" href="#beranda">Beranda</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold text-white" href="#layanan">Layanan</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold text-white" href="#mengapa">Tentang</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold text-white" href="#kontak">Kontak</a></li>
            </ul>
        </div>

        <!-- Profil/Login di Kanan -->
        <div class="d-flex align-items-center">
            @guest
                <a class="btn btn-light text-primary-custom fw-semibold px-3 me-2" href="{{ route('login') }}">Masuk</a>
                <a class="btn btn-outline-light fw-semibold px-3" href="{{ route('register') }}">Daftar</a>
            @else
                <div class="dropdown">
                    <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Auth::user()->gambar)
                            <img src="{{ asset('storage/' . Auth::user()->gambar) }}" 
                                alt="Profil" class="rounded-circle me-2" width="35" height="35" 
                                style="object-fit: cover; border: 2px solid #fff;">
                        @else
                            <span class="me-2 fs-4">👤</span>
                        @endif
                        <span class="fw-semibold">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li><a class="dropdown-item" href="{{ route('pemesan.profil') }}">Profil Saya</a></li>
                        <li><a class="dropdown-item" href="{{ route('pemesan.riwayat') }}">Riwayat</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest
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
                    <a href="{{ route('pemesan.form.pemesanan') }}" class="btn btn-light text-primary-custom fw-semibold px-4 py-2 rounded-pill">Pesan Sekarang</a>
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
                    <div class="card py-5 shadow-sm" style="height: 400px;">
                        <div class="card-body">
                            <h5 class="fw-bold text-primary-custom">Sedot WC</h5>
                            <p class="text-muted mt-3">Kami menyediakan layanan sedot WC cepat, bersih, dan profesional untuk rumah tangga, kantor, restoran, maupun gedung komersial.
                                Tim kami menggunakan peralatan modern dan aman, memastikan penyedotan dilakukan secara tuntas tanpa menimbulkan bau atau kerusakan pada saluran pembuangan.
                                Layanan ini juga mencakup pemeriksaan tangki septik serta perawatan berkala untuk mencegah masalah di kemudian hari.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card py-5 shadow-sm" style="height: 400px;">
                        <div class="card-body">
                            <h5 class="fw-bold text-primary-custom">Pelancaran</h5>
                            <p class="text-muted mt-3">Kami melayani pelancaran saluran air, wastafel, kamar mandi, dan pembuangan yang tersumbat menggunakan alat bertekanan tinggi. Dikerjakan oleh tenaga ahli berpengalaman, proses dilakukan dengan cepat dan tanpa merusak instalasi pipa. Cocok untuk Anda yang mengalami masalah saluran mampet di rumah, kantor, atau tempat usaha dengan hasil yang bersih dan tahan lama.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== MENGAPA HARUS MEMILIH KAMI ===== -->
    <section id="mengapa" class="bg-primary-custom text-white text-center">
        <div class="container">
            <h2 class="fw-bold mb-5">Mengapa Harus Memilih Kami</h2>
            <div class="row g-4">

                <!-- Keunggulan 1 -->
                <div class="col-md-4">
                    <div class="card bg-light text-primary-custom py-5">
                        <div class="card-body fw-semibold" style="height: 150px;">
                            🔧 Tenaga Profesional dan Berpengalaman
                            <p class="mt-2 text-muted small">
                                Dikerjakan oleh tim ahli yang berpengalaman bertahun-tahun dalam menangani berbagai permasalahan saluran air dan septic tank.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Keunggulan 2 -->
                <div class="col-md-4">
                    <div class="card bg-light text-primary-custom py-5">
                        <div class="card-body fw-semibold" style="height: 150px;">
                            ⚡ Pelayanan Cepat dan Tepat Waktu
                            <p class="mt-2 text-muted small">
                                Kami siap merespons panggilan pelanggan dengan cepat dan menyelesaikan pekerjaan sesuai jadwal yang telah disepakati.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Keunggulan 3 -->
                <div class="col-md-4">
                    <div class="card bg-light text-primary-custom py-5">
                        <div class="card-body fw-semibold" style="height: 150px;">
                            💧 Peralatan Modern dan Aman
                            <p class="mt-2 text-muted small">
                                Menggunakan peralatan vakum dan tekanan tinggi yang mutakhir untuk memastikan hasil bersih tanpa merusak instalasi.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Keunggulan 4 -->
                <div class="col-md-4">
                    <div class="card bg-light text-primary-custom py-5">
                        <div class="card-body fw-semibold" style="height: 150px;">
                            💰 Harga Transparan dan Terjangkau
                            <p class="mt-2 text-muted small">
                                Biaya layanan dijelaskan secara terbuka sebelum pekerjaan dimulai, tanpa tambahan biaya tersembunyi.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Keunggulan 5 -->
                <div class="col-md-4">
                    <div class="card bg-light text-primary-custom py-5">
                        <div class="card-body fw-semibold" style="height: 150px;">
                            🧾 Garansi Kepuasan Pelanggan
                            <p class="mt-2 text-muted small">
                                Kami memberikan jaminan kepuasan terhadap hasil kerja. Jika ada keluhan, tim kami siap menindaklanjuti dengan cepat.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Keunggulan 6 -->
                <div class="col-md-4">
                    <div class="card bg-light text-primary-custom py-5">
                        <div class="card-body fw-semibold" style="height: 150px;">
                            🌱 Ramah Lingkungan
                            <p class="mt-2 text-muted small">
                                Proses pembuangan limbah dilakukan sesuai standar lingkungan agar tetap aman dan tidak mencemari sekitar.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ===== TESTIMONI ===== -->
    <section id="testimoni" class="bg-light-custom text-center">
        <div class="container">
            <h2 class="fw-bold mb-5 text-primary-custom">Testimoni</h2>
            <div class="row g-4">
                @forelse($testimoni as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm p-3 h-100">
                            <div class="d-flex align-items-center text-start">
                                <div class="me-3 flex-shrink-0">
                                    <img src="{{ asset('storage/' . $item->user_relasi->gambar) }}"
                                        alt="Foto {{ $item->testimoni_pemesanan_relasi->nama_pemesan ?? 'Anonim' }}"
                                        class="rounded-circle"
                                        style="width: 70px; height: 70px; object-fit: cover;">
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">{{ $item->testimoni_pemesanan_relasi->nama_pemesan ?? 'Anonim' }}</h6>
                                    <p class="fst-italic mb-0 text-muted text-truncate-multiline">
                                        "{{ $item->komentar }}"
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">Belum ada testimoni.</p>
                    </div>
                @endforelse
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