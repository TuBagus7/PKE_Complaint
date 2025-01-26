@extends('layouts.admin')

@section('title', 'Tambah Data Categpory')

@section('content')
                    <a href="{{route('admin.category.index')}}" class="btn btn-danger mb-3">Kembali</a>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}">

                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="image">Icon Category</label>
                                    <input type="file" class="form-control @error ('image') is-invalid @enderror" id="image" name="image">
                                    
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{$message}}
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