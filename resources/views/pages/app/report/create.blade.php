@extends('layouts.no-nav')

@section('title', 'Tambah Laporan')

@section('content')
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-sA+4e1pQ+6V7t8VZt6gZ4J6sJv5+Xg1c7z8+gG2U5kM="
      crossorigin=""/>
@endpush
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
            <div id="map" style="height:400px;"></div>
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
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-o9N1jY4Y2V4K3yK5Q6xM1ZcVh5K8V7x6+5U9J6Z6b+8="
        crossorigin=""></script>

<script>
    // Default coordinates (Jakarta) if hidden inputs are empty
    var defaultLat = -6.200000;
    var defaultLng = 106.816666;

    var latInput = document.getElementById('lat');
    var lngInput = document.getElementById('lng');

    var initLat = parseFloat(latInput.value) || defaultLat;
    var initLng = parseFloat(lngInput.value) || defaultLng;

    var map = L.map('map').setView([initLat, initLng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var marker = L.marker([initLat, initLng], {draggable:true}).addTo(map);

    marker.on('dragend', function(e){
        var pos = e.target.getLatLng();
        latInput.value = pos.lat;
        lngInput.value = pos.lng;
    });

    map.on('click', function(e){
        marker.setLatLng(e.latlng);
        latInput.value = e.latlng.lat;
        lngInput.value = e.latlng.lng;
    });
</script>

<script>
    // Ensure hidden inputs have initial coordinates even if user doesn't interact with the map
    latInput.value = initLat;
    lngInput.value = initLng;
</script>
@endsection