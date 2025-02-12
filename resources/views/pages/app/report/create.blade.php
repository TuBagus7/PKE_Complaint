@extends('layouts.no-nav')

@section('title', 'Tambah Laporan')

@section('content')
 <h3 class="mb-3">Laporkan segera masalahmu di sini!</h3>

        <p class="text-description">Isi form dibawah ini dengan baik dan benar sehingga kami dapat memvalidasi dan
            menangani
            laporan anda
            secepatnya</p>

        <form action="{{ route('report.store') }}" method="POST" class="mt-4" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="lat" name="latitude">
        <input type="hidden" id="lng" name="longitude">

        <div class="mb-3">
            <label for="title" class="form-label">Judul Laporan</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ old('title') }}">

            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="mb-3">
            <label for="report_category_id" class="form-label">Kategori Laporan</label>

            <select name="report_category_id" class="form-control @error('report_category_id') is-invalid @enderror">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if (old('report_category_id') == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('report_category_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Bukti Laporan</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                style="display: none;">
            <img alt="image" id="image-preview" class="img-fluid rounded-2 mb-3 border">

            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Ceritakan Laporan Kamu</label>
            <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" value="{{ old('description') }}" rows="5"></textarea>

            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="mb-3">
            <label for="map" class="form-label">Lokasi Laporan</label>
            <div id="map"></div>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Lokasi Lengkap</label>
            <textarea type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                value="{{ old('address') }}" rows="5"></textarea>

            @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <button class="btn btn-primary w-100 mt-2" type="submit" color="primary">
            Laporkan
        </button>
    </form>
@endsection

@section('script')
<script>
        // Ambil base64 dari localStorage
        var imageBase64 = localStorage.getItem('image');

        // Mengubah base64 menjadi binary Blob
        function base64ToBlob(base64, mime) {
            var byteString = atob(base64.split(',')[1]);
            var ab = new ArrayBuffer(byteString.length);
            var ia = new Uint8Array(ab);
            for (var i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }
            return new Blob([ab], {
                type: mime
            });
        }

        // Fungsi untuk membuat objek file dan set ke input file
        function setFileInputFromBase64(base64) {
            // Mengubah base64 menjadi Blob
            var blob = base64ToBlob(base64, 'image/jpeg'); // Ganti dengan tipe mime sesuai gambar Anda
            var file = new File([blob], 'image.jpg', {
                type: 'image/jpeg'
            }); // Nama file dan tipe MIME

            // Set file ke input file
            var imageInput = document.getElementById('image');
            var dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            imageInput.files = dataTransfer.files;

            // Menampilkan preview gambar
            var imagePreview = document.getElementById('image-preview');
            imagePreview.src = URL.createObjectURL(file);
        }

        // Set nilai input file dan preview gambar
        setFileInputFromBase64(imageBase64);
    </script>

@endsection