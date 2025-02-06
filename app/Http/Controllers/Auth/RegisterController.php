<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreResidentRequest;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Interfaces\ResidentRepositoryInterface;

class RegisterController extends Controller
{
    private ResidentRepositoryInterface $residentRepository;

    public function __construct(ResidentRepositoryInterface $residentRepository)
    {
        $this->residentRepository = $residentRepository;
    }
    public function index()
    {
        return view('pages.auth.register');
    }
    public function store(StoreResidentRequest $request)
    {
        $data = $request->validated();
        $data['avatar'] = $request->file('avatar')->store('assets/avatar', 'public');

        $this->residentRepository->createResident($data);

        // SweetAlert untuk pesan sukses
        Swal::toast('Data Pegawai Berhasil Ditambahkan', 'success')
            ->position('top-end')
            ->timerProgressBar()
            ->autoClose(3000);

        return redirect()->route('login')->with('success', "Yeyy, Pendaftaran Berhasil, Silahkan Login");



    }
}

