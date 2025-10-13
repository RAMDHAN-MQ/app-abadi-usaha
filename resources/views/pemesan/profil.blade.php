@extends('layouts.master')

@section('title', 'Profil Pengguna')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body text-center">
                    <h4 class="fw-bold mb-3 text-primary">Profil Pengguna</h4>
                    <div class="mb-3">
                        @if($user->gambar)
                            <img src="{{ asset('storage/' . $user->gambar) }}" class="rounded-circle shadow" width="120" height="120" alt="Foto Profil" style="object-fit: cover; aspect-ratio: 1/1;">
                        @else
                            <img src="{{ asset('storage/default/user.png') }}" class="rounded-circle shadow" width="120" height="120" alt="Foto Default" style="object-fit: cover; aspect-ratio: 1/1;">
                        @endif
                    </div>

                    <form action="{{ route('pemesan.updateProfil') }}" method="POST" enctype="multipart/form-data" class="text-start">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $user->alamat) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nomor Telepon</label>
                            <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $user->no_telp) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Foto Profil</label>
                            <input type="file" name="gambar" id="gambarInput" class="form-control">

                            <div class="mt-3 text-center">
                                <img id="previewImage" src="#" alt="Preview" class="rounded shadow" style="max-width: 100%; display: none;">
                            </div>

                            <canvas id="croppedCanvas" style="display: none;"></canvas>
                            <input type="hidden" name="cropped_image" id="croppedImageInput">
                        </div>

                        <div class="d-grid mt-3">
                            <button type="button" id="cropButton" class="btn btn-success rounded-pill py-2" style="display: none;">Crop & Simpan</button>
                        </div>

                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-primary rounded-pill py-2">Simpan Perubahan</button>
                        </div>
                    </form>

                    <a href="{{ route('pemesan.beranda') }}" class="btn btn-link mt-3">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/cropperjs@1.6.1/dist/cropper.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/cropperjs@1.6.1/dist/cropper.min.css">

<script>
let cropper;
const image = document.getElementById('previewImage');
const input = document.getElementById('gambarInput');
const cropButton = document.getElementById('cropButton');
const croppedInput = document.getElementById('croppedImageInput');

input.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(event) {
        image.src = event.target.result;
        image.style.display = 'block';

        if (cropper) cropper.destroy();

        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 1,
            minCropBoxWidth: 100,
            minCropBoxHeight: 100,
        });

        cropButton.style.display = 'block';
    };
    reader.readAsDataURL(file);
});

cropButton.addEventListener('click', function() {
    const canvas = cropper.getCroppedCanvas({
        width: 400,
        height: 400,
    });

    croppedInput.value = canvas.toDataURL('image/png');
    cropButton.textContent = "Sudah Dicrop ✓";
    cropButton.classList.replace('btn-success', 'btn-secondary');
});
</script>
@endpush
