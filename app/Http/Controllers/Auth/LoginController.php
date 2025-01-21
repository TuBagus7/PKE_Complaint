<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Repositories\AuthRepository;
use Auth; 
use Illuminate\Http\Request;        

class LoginController extends Controller
{
    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function index()
    {
        return view('pages.auth.login');
    }

   public function store(StoreLoginRequest $request)
{
    $credentials = $request->validated();

    if ($this->authRepository->login($credentials)) {
        dd('Login Berhasil');
    }

    return redirect()->route('auth.login')->withErrors([
        'email' => 'Email atau Password Salah',
    ]);
}

}
