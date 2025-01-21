<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginRequest;
use App\Interface\AuthRepositoryInterface;
use App\Repositories\AuthRepository;
use Auth; 
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private AuthRepository $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function index()
    {
        return view('auth.login');
    }

    public function store(StoreLoginRequest $request)
    {
        $credentials = $request -> validated();
    }
}
