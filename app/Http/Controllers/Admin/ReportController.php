<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ReportCategoryRepositoryInterface;
use App\Interfaces\ResidentRepositoryInterface;
use Illuminate\Http\Request;
use App\Interfaces\ReportRepositoryInterface;
use App\Http\Requests\StoreReportRequest;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Http\Requests\UpdateReportRequest;
use Illuminate\Support\Facades\Storage;


class ReportController extends Controller
{
    private ReportRepositoryInterface $reportRepository;
    private ReportCategoryRepositoryInterface $reportCategoryRepository;
    private ResidentRepositoryInterface $residentRepository;

    public function __construct(
        ReportRepositoryInterface $reportRepository,
        ReportCategoryRepositoryInterface $reportCategoryRepository,
        ResidentRepositoryInterface $residentRepository)
    {
        $this->reportRepository = $reportRepository;
        $this->reportCategoryRepository = $reportCategoryRepository;
        $this->residentRepository = $residentRepository;
    }
    public function index()
    {
        $reports = $this->reportRepository->getAllReports();

        return view('pages.admin.report.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $residents = $this->residentRepository->getAllResidents();
        $categories = $this->reportCategoryRepository->getAllReportCategories();
        return view('pages.admin.report.create', compact('residents', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportRequest $request)
    {
        $data = $request->validated();
        $data['code'] = 'PKE-LAPOR' . mt_rand(100000, 999999);
        $data['image'] = $request->file('image')->store('assets/report', 'public'); // Upload file image

        $this->reportRepository->createReport($data);   

        // SweetAlert untuk pesan sukses
        Swal::toast('Data Laporan Berhasil Ditambahkan', 'success')
            ->position('top-end')
            ->timerProgressBar()
            ->autoClose(3000);

        // Redirect ke rute yang benar
        return redirect()->route('admin.report.index');
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
        $report = $this->reportRepository->getReportById($id);
        $residents = $this->residentRepository->getAllResidents();
        $categories = $this->reportCategoryRepository->getAllReportCategories();

        return view('pages.admin.report.edit', compact('report', 'residents', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $report = $this->reportRepository->getReportById($id);
            if ($report->image) {
                Storage::disk('public')->delete($report->image);
            }
            $data['image'] = $request->file('image')->store('assets/report', 'public');
        }

        $this->reportRepository->updateReport($id, $data);

        // SweetAlert untuk pesan sukses
        Swal::toast('Data Laporan Berhasil Diubah', 'success')
            ->position('top-end')
            ->timerProgressBar()
            ->autoClose(3000);

        return redirect()->route('admin.report.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
