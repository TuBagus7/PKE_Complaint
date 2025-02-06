@extends('layouts.no-nav')

@section('title', 'Tambah Laporan')

@section('content')
 <h3 class="mb-3">Laporkan segera masalahmu di sini!</h3>

        <p class="text-description">Isi form dibawah ini dengan baik dan benar sehingga kami dapat memvalidasi dan
            menangani
            laporan anda
            secepatnya</p>

        <form action="success.html" method="POST" class="mt-4">
            <input type="hidden" id="lat" name="lat">
            <input type="hidden" id="lng" name="lng">

            <div class="mb-3">
                <label for="title" class="form-label">Judul Laporan</label>
                <input type="text" class="form-control is-invalid" id="title" name="title">
                <div class="invalid-feedback">
                    Judul laporan harus diisi
                </div>
            </div>

            <div class="mb-3">
                <label for="report_category_id" class="form-label">Kategori Laporan</label>
                <select class="form-select is-invalid" id="report_category_id" name="report_category_id">
                    <option value="1">Pengaduan</option>
                    <option value="2">Permintaan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Bukti Laporan</label>
                <input type="file" class="form-control" id="image" name="image" style="display: none;">
                <img alt="image" id="image-preview" class="img-fluid rounded-2 mb-3 border">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Ceritakan Laporan Kamu</label>
                <textarea class="form-control" id="description" name="description" rows="5"></textarea>
            </div>

            <div class="mb-3">
                <label for="map" class="form-label">Lokasi Laporan</label>
                <div id="map"></div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat Lengkap</label>
                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
            </div>

            <button class="btn btn-primary w-100 mt-2" type="submit" color="primary">
                Laporkan
            </button>
        </form>
@endsection

@section('script')
<script>
    var image = localStorage.getItem('image');
    var imagePreview = document.getElementById('image-preview');
    imagePreview.value = image;
    imagePreview.src = image;
    </script>

@endsection