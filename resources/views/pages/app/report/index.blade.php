@extends('layouts.app')

@section('title', 'Daftar Pengaduan')

@section('content')
<div class="py-3" id="reports">
            <div class="d-flex justify-content-between align-items-center">
                <p class="text-muted">{{$reports->count()}} Pengaduan</p>

                <button class="btn btn-filter" type="button">
                    <i class="fa-solid fa-filter me-2"></i>
                    Filter
                </button>

            </div>

            <div class="d-flex flex-column gap-3 mt-3">
                @foreach ($reports as $report)
                <div class="card card-report border-0 shadow-none">
                    <a href="{{route('report.show', $report->code)}}" class="text-decoration-none text-dark">
                        <div class="card-body p-0">
                            <div class="card-report-image position-relative mb-2">
                                <img src="{{ asset('storage/' . $report->image) }}" alt="" class="w-full h-auto object-fit:contain">
                                
                                @if ($report->reportStatuses->last()->status == 'delivered')
                                    <div class="badge-status accepted">Diterima</div>
                                @endif
                                @if ($report->reportStatuses->last()->status == 'progress')
                                    <div class="badge-status on-process">Diproses</div>
                                @endif
                                @if ($report->reportStatuses->last()->status == 'completed')
                                    <div class="badge-status done">Selesai</div>
                                @endif
                                @if ($report->reportStatuses->last()->status == 'rejected')
                                    <div class="badge-status rejected" style="background-color: #FF0000">Ditolak</div>
                                @endif 
                            </div>

                            <div class="d-flex justify-content-between align-items-end mb-2">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/app/images/icons/MapPin.png') }}" alt="map pin" class="icon me-2">
                                    <p class="text-primary city">{{ $report->address }}</p>
                                </div>
                                <p class="text-secondary date">{{\Carbon\Carbon::parse($report->created_at)->format('d M Y H:i')}}</p>
                            </div>

                            <h1 class="card-title">{{$report->title}}</h1>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection