@extends('layouts.admin')

@section('title', 'Data Pegawai')

@section('content')
<div class="container-fluid">
    <!-- Tombol Tambah Data -->
    <a href="create.html" class="btn btn-primary mb-3">Tambah Data</a>

    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Data Pegawai</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Avatar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($residents as $resident)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $resident->user->email }}</td>
                            <td>{{ $resident->user->name }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $resident->avatar) }}" alt="avatar" width="100">
                            </td>
                            <td>
                                <a href="edit.html" class="btn btn-warning btn-sm">Edit</a>
                                <a href="show.html" class="btn btn-info btn-sm">Show</a>
                                <form action="" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
