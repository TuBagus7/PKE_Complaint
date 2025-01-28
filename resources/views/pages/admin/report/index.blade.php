@extends('layouts.admin')

@section('title', 'Data Laporan')

@section('content')
<div class="container-fluid">
    <!-- Tombol Tambah Data -->
    <a href="{{route('admin.report.create')}}" class="btn btn-primary mb-3">Tambah Data</a>

    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Data Laporan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Laporan</th>
                            <th>Pelapor</th>
                            <th>Kategori Laporan</th>
                            <th>Judul Laporan</th>
                            <th>Bukti Laporan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->code}}</td>
                            <td>{{ $report->resident->user->name}}</td>
                            <td>{{ $report->category->name}}</td>
                            <td>{{ $report->title}}</td>
                            <td>
                                <img src="{{ asset('storage/' . $report->image) }}" alt="image" width="100">
                            </td>
                            <td>
                                <a href="{{route('admin.report.edit', $report->id)}}" 
                                class="btn btn-warning btn-sm">Edit</a>  
                                
                                <a href="{{route('admin.report.show', $report->id)}}" class="btn btn-info btn-sm">Show</a>
                                
                                <form action ="{{route('admin.report.destroy', $report->id)}}" method="POST" class="d-inline">
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
