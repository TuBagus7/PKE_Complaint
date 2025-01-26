<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\ReportCategoryRepositoryInterface;
use App\Http\Requests\StoreReportCategoryRequest;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateReportCategoryRequest;
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
    $data['image'] = $request->file('image')->store('assets/category', 'public'); // Upload file image

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
        $category = $this->reportCategoryRepository->getReportCategoryById($id);

        return view('pages.admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->reportCategoryRepository->getReportCategoryById($id);

        return view('pages.admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportCategoryRequest $request, string $id)
    {
       $data = $request->validated();

        if ($request->hasFile('image')) {
            $category = $this->reportCategoryRepository->getReportCategoryById($id);
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('assets/category', 'public');
        }

        $this->reportCategoryRepository->updateReportCategory($id, $data);

        // SweetAlert untuk pesan sukses
        Swal::toast('Data Kategori Berhasil Diubah', 'success')
            ->position('top-end')
            ->timerProgressBar()
            ->autoClose(3000);

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->reportCategoryRepository->getReportCategoryById($id);

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $this->reportCategoryRepository->deleteReportCategory($id);

        // SweetAlert untuk pesan sukses
        Swal::toast('Data Kategori Berhasil Dihapus', 'success')
            ->position('top-end')
            ->timerProgressBar()
            ->autoClose(3000);

        return redirect()->route('admin.category.index');
    }
}
