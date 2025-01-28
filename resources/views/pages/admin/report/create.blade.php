@extends('layouts.admin')

@section('title', 'Tambah Data Laporan')

@section('content')
                    <a href="{{route('admin.report.index')}}" class="btn btn-danger mb-3">Kembali</a>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Laporan</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.report.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="code">Kode</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" 
                                    name="code" value="AUTO" disabled>

                                    @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="resident">Pelapor / Pegawai</label>
                                    <select name="resident_id" class="form-control @error('resident_id') is-invalid @enderror">
                                        @foreach ($residents as $resident)
                                            <option value="{{$resident->id}}">{{$resident->user->email}} - {{$resident->user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('residentid')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category">Kategori</label>
                                    <select name="report_category_id" class="form-control @error('report_category_id') is-invalid @enderror">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('report_category_id')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="title">Judul Laporan</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" 
                                    name="title" value="{{old('title')}}">

                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi Laporan</label>
                                    <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" 
                                    name="description" rows="5">{{old('description')}}</textarea>

                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="image">Bukti Laporan</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" 
                                    name="image">

                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" 
                                    name="latitude" value="{{old('latitude')}}">

                                    @error('latitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" 
                                    name="longitude" value="{{old('longitude')}}">

                                    @error('longitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="address">Alamat Laporan</label>
                                    <textarea type="text" class="form-control @error('address') is-invalid @enderror" id="address" 
                                    name="address" rows="5">{{old('address')}}</textarea>

                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- <div class="form-group">
                                    <label for="tanggal">Tanggal Data</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                                </div> -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>


@endsection