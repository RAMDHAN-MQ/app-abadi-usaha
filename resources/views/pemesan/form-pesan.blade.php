<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan - Abadi Usaha</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: #2D2F48;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            max-width: 550px;
            width: 100%;
            background: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        h2 {
            font-weight: 700;
            margin-bottom: 25px;
            color: #000;
        }

        .btn-maps {
            background-color: #1C1E53;
            color: white;
            font-size: 0.85rem;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .btn-maps:hover {
            background-color: #313473;
        }

        #map {
            height: 300px;
            width: 100%;
            border-radius: 10px;
            margin-top: 10px;
            display: none;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Form Pemesanan</h2>

    <form action="{{ route('pemesan.form.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama anda" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label><br>
            <button type="button" class="btn-maps mb-2" onclick="toggleMap()">📍 Pilih dengan Maps</button>
            <div id="map"></div>
            <textarea id="alamat" name="alamat" class="form-control mt-2" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
            <input type="text" id="detail alamat" name="detail_alamat" class="form-control" placeholder="Detail alamat anda (rumah warna hijau)" required>
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
        </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label">Nomor HP</label>
            <input type="text" id="no_telp" name="no_telp" class="form-control" placeholder="Contoh: 0812xxxxxxxx" required>
        </div>

        <div class="mb-3">
            <label for="layanan" class="form-label">Jenis Layanan</label>
            <select id="layanan" name="layanan" class="form-select" required>
                <option value="" selected disabled>Pilih layanan...</option>
                @foreach($layanan as $item)
                <option value="{{ $item->id }}">{{ $item->nama_layanan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" id="harga" name="harga" class="form-control" placeholder="Rp 0" readonly>
        </div>

        <div class="d-flex justify-content-start gap-2">
            <button type="submit" class="btn btn-primary px-4">Pesan</button>
            <a href="{{ url('/') }}" class="btn btn-secondary px-4">Kembali</a>
        </div>
    </form>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    const layananSelect = document.getElementById('layanan');
    const hargaInput = document.getElementById('harga');
    layananSelect.addEventListener('change', function () {
        const harga = {
            'Sedot WC': 'Rp 700.000',
            'Pelancaran Saluran': 'Rp 550.000',
        };
        hargaInput.value = harga[this.value] || '';
    });

    let map, marker;

function toggleMap() {
    const mapDiv = document.getElementById("map");
    mapDiv.style.display = mapDiv.style.display === "none" ? "block" : "none";

    if (!map) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (pos) => {
                    const lat = pos.coords.latitude;
                    const lon = pos.coords.longitude;
                    initMap(lat, lon);
                },
                (err) => {
                    console.warn("Gagal mendapatkan lokasi:", err);
                    alert("Tidak dapat mengakses lokasi Anda, peta akan menampilkan Jakarta sebagai default.");
                    initMap(-6.200000, 106.816666);
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        } else {
            alert("Browser Anda tidak mendukung geolokasi.");
            initMap(-6.200000, 106.816666);
        }
    }
}


    function initMap(lat, lon) {
        map = L.map('map').setView([lat, lon], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        marker = L.marker([lat, lon], {draggable: true}).addTo(map);

        updateAddress();

        marker.on('dragend', updateAddress);
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            updateAddress();
        });
    }

    function updateAddress() {
        const latlng = marker.getLatLng();
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;

        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latlng.lat}&lon=${latlng.lng}&format=json`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('alamat').value = data.display_name || 'Alamat tidak ditemukan';
            })
            .catch(err => console.error(err));
    }
</script>
</body>
</html>
