@extends('layouts.app')

@section('title', 'Home')

@section('content')
        <h6 class="greeting">Hi, User 👋</h6>
        <h4 class="home-headline">Laporkan masalahmu dan kami segera atasi itu</h4>
        <div class="d-flex align-items-center justify-content-between gap-4 py-3 overflow-auto" id="category"
            style="white-space: nowrap;">
            @foreach ( $categories as $category )
                <a href="" class="category d-inline-block">
                    <div class="icon">
                        <img src="{{asset('storage/' . $category->image)}}" alt="icon">
                    </div>
                    <p>{{$category->name}}</p>
                </a>
            @endforeach
        </div>

        <div class="py-3" id="reports">
            <div class="d-flex justify-content-between align-items-center">
                <h6>Pengaduan terbaru</h6>
                <a href="reports.html" class="text-primary text-decoration-none show-more">
                    Lihat semua
                </a>
            </div>

            <div class="d-flex flex-column gap-3 mt-3">
                <div class="card card-report border-0 shadow-none">
                    <a href="details.html" class="text-decoration-none text-dark">
                        <div class="card-body p-0">
                            <div class="card-report-image position-relative mb-2">
                                <img src="assets/images/report-1.png" alt="">

                                <div class="badge-status on-process">
                                    Diproses
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-end mb-2">
                                <div class="d-flex align-items-center ">
                                    <img src="assets/images/icons/MapPin.png" alt="map pin" class="icon me-2">
                                    <p class="text-primary city">
                                        Pekuncen, Banyumas
                                    </p>
                                </div>

                                <p class="text-secondary date">
                                    23 August 2024
                                </p>
                            </div>

                            <h1 class="card-title">
                                Jembatan roboh di Pekuncen, Banyumas
                            </h1>
                        </div>
                    </a>
                </div>

                <div class="card card-report border-0 shadow-none">
                    <a href="details.html" class="text-decoration-none text-dark">
                        <div class="card-body p-0">
                            <div class="card-report-image position-relative mb-2">
                                <img src="assets/images/report-2.jpg" alt="">

                                <div class="badge-status done">
                                    Selesai
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-end mb-2">
                                <div class="d-flex align-items-center ">
                                    <img src="assets/images/icons/MapPin.png" alt="map pin" class="icon me-2">
                                    <p class="text-primary city">
                                        Purwokerto, Banyumas
                                    </p>
                                </div>

                                <p class="text-secondary date">
                                    23 August 2024
                                </p>
                            </div>

                            <h1 class="card-title">
                                Jalan Rusak Parah
                            </h1>
                        </div>
                    </a>
                </div>
                <div class="card card-report border-0 shadow-none">
                    <a href="details.html" class="text-decoration-none text-dark">
                        <div class="card-body p-0">
                            <div class="card-report-image position-relative mb-2">
                                <img src="assets/images/report-1.png" alt="">

                                <div class="badge-status on-process">
                                    Diproses
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-end mb-2">
                                <div class="d-flex align-items-center ">
                                    <img src="assets/images/icons/MapPin.png" alt="map pin" class="icon me-2">
                                    <p class="text-primary city">
                                        Pekuncen, Banyumas
                                    </p>
                                </div>

                                <p class="text-secondary date">
                                    23 August 2024
                                </p>
                            </div>

                            <h1 class="card-title">
                                Jembatan roboh di Pekuncen, Banyumas
                            </h1>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection