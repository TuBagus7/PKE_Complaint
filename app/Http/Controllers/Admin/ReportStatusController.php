<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportStatusRequest;
use App\Interfaces\ReportRepositoryInterface;
use App\Interfaces\ReportStatusRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateReportStatusRequest;

class ReportStatusController extends Controller
{
    private ReportRepositoryInterface $reportRepository;
    private ReportStatusRepositoryInterface $reportStatusRepository;

    public function __construct(
        ReportRepositoryInterface $reportRepository,
        ReportStatusRepositoryInterface $reportStatusRepository
    ) {
        $this->reportRepository = $reportRepository;
        $this->reportStatusRepository = $reportStatusRepository;
    }

    /**
     * Menampilkan daftar status laporan.
     */
    public function index()
    {
        $reportStatuses = $this->reportStatusRepository->getAllReportStatuses();
        return view('pages.admin.report-status.index', compact('reportStatuses'));
    }

    /**
     * Menampilkan form untuk menambah status laporan berdasarkan laporan tertentu.
     */
    public function create($reportId)
{
    // Mengambil data laporan berdasarkan ID
    $report = $this->reportRepository->getReportById($reportId);

    
    return view('pages.admin.report-status.create', compact('report'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportStatusRequest $request)
{
    $data = $request->validated();
    if ($request->image){
    $data['image'] = $request->file('image')->store('assets/report-status/image', 'public'); // Upload file image
    }
    $this->reportStatusRepository->createReportStatus($data);   

    // SweetAlert untuk pesan sukses
    Swal::toast('Data Progress Laporan Berhasil Ditambahkan', 'success')
        ->position('top-end')
        ->timerProgressBar()
        ->autoClose(3000);

    // Redirect ke rute yang benar
    return redirect()->route('admin.report.show', $request->report_id);
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
        $status = $this->reportStatusRepository->getReportStatusById($id);

        return view('pages.admin.report-status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportStatusRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $status = $this->reportStatusRepository->getReportStatusById($id);
            if ($status->image) {
                Storage::disk('public')->delete($status->image);
            }
            $data['image'] = $request->file('image')->store('assets/report-status/image', 'public');
        }

        $this->reportStatusRepository->updateReportStatus($id, $data);

        // SweetAlert untuk pesan sukses
        Swal::toast('Data Progress Laporan Berhasil Diubah', 'success')
            ->position('top-end')
            ->timerProgressBar()
            ->autoClose(3000);

        return redirect()->route('admin.report.show', $request->report_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
