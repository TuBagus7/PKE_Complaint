<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ResidentRepositoryInterface;
use App\Http\Requests\StoreResidentRequest;     
use App\Http\Requests\UpdateResidentRequest;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use Illuminate\Support\Facades\Storage;

class ResidentController extends Controller
{
    private ResidentRepositoryInterface $residentRepository;

    public function __construct(ResidentRepositoryInterface $residentRepository)
    {
        $this->residentRepository = $residentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\View\View
    {
        $residents = $this->residentRepository->getAllResidents();

        return view('pages.admin.resident.index', compact('residents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\View\View
    {
        return view('pages.admin.resident.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResidentRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('assets/avatar', 'public');
        }

        $this->residentRepository->createResident($data);

        // SweetAlert untuk pesan sukses
        Swal::toast('Data Pegawai Berhasil Ditambahkan', 'success')
            ->position('top-end')
            ->timerProgressBar()
            ->autoClose(3000);

        return redirect()->route('admin.resident.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): \Illuminate\View\View
    {
        $resident = $this->residentRepository->getResidentsById($id);

        return view('pages.admin.resident.show', compact('resident'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): \Illuminate\View\View
    {
        $resident = $this->residentRepository->getResidentsById($id);

        return view('pages.admin.resident.edit', compact('resident'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResidentRequest $request, int $id){
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $resident = $this->residentRepository->getResidentsById($id);
            if ($resident->avatar) {
                Storage::disk('public')->delete($resident->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('assets/avatar', 'public');
        }

        $this->residentRepository->updateResident($id, $data);

        // SweetAlert untuk pesan sukses
        Swal::toast('Data Pegawai Berhasil Diubah', 'success')
            ->position('top-end')
            ->timerProgressBar()
            ->autoClose(3000);

        return redirect()->route('admin.resident.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $resident = $this->residentRepository->getResidentsById($id);

        if ($resident->avatar) {
            Storage::disk('public')->delete($resident->avatar);
        }

        $this->residentRepository->deleteResident($id);

        // SweetAlert untuk pesan sukses
        Swal::toast('Data Pegawai Berhasil Dihapus', 'success')
            ->position('top-end')
            ->timerProgressBar()
            ->autoClose(3000);

        return redirect()->route('admin.resident.index');
    }
}
