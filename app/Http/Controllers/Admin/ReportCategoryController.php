<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\ReportCategoryRepositoryInterface;
use App\Http\Requests\StoreReportCategoryRequest;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class ReportCategoryController extends Controller
{
    private ReportCategoryRepositoryInterface $reportCategoryRepository;

    public function __construct(ReportCategoryRepositoryInterface $reportCategoryRepository)
    {
        $this->reportCategoryRepository = $reportCategoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->reportCategoryRepository->getAllReportCategories();

        return view('pages.admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportCategoryRequest $request) {
    $data = $request->validated();
    $data['image'] = $request->file('image')->store('assets/category/image', 'public'); // Upload file image

    $this->reportCategoryRepository->createReportCategory($data);   

    // SweetAlert untuk pesan sukses
    Swal::toast('Data Kategori Berhasil Ditambahkan', 'success')
        ->position('top-end')
        ->timerProgressBar()
        ->autoClose(3000);

    // Redirect ke rute yang benar
    return redirect()->route('admin.category.index');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
