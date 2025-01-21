@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<h5 class="fw-bold mt-5">Selamat datang di PKE 👋</h5>
<h6 class="text-muted mt-2">Perbaikan Komputer dan Elektronik Universitas Islam Riau</h6>
        <p class="text-muted mt-2">Silahkan masuk untuk melanjutkan</p>

        <button class="btn btn-primary py-2 w-100 mt-4" type="button">
            <i class="fa-brands fa-google me-2"></i>
            Masuk dengan Google
        </button>

        <div class="d-flex align-items-center mt-2">
            <hr class="flex-grow-1">
            <span class="mx-2">atau</span>
            <hr class="flex-grow-1">
        </div>

        <form action="{{route ('auth.login.store')}}" method="POST" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">

                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">

                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button class="btn btn-primary w-100 mt-2" type="submit" color="primary" id="btn-login">
                Masuk
            </button>

            <div class="d-flex justify-content-between mt-3">
                <a href="signup.html" class="text-decoration-none text-primary">Belum punya akun?</a>
                <a href="" class="text-decoration-none text-primary">Lupa
                    Password</a>
            </div>

        </form>
@endsection