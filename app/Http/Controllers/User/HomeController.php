<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Interfaces\ReportCategoryRepositoryInterface;
use App\Interfaces\ReportRepositoryInterface;

class HomeController extends Controller
{
    
    private ReportRepositoryInterface $reportRepository;
    private ReportCategoryRepositoryInterface $reportCategoryRepository;

    public function __construct(
    ReportRepositoryInterface $reportRepository,
    ReportCategoryRepositoryInterface $reportCategoryRepository
)
{
    $this->middleware('auth'); // 🔒 Tambahkan ini
    $this->reportCategoryRepository = $reportCategoryRepository;
    $this->reportRepository = $reportRepository;
}


    public function index()
    {
        $categories = $this->reportCategoryRepository->getAllReportCategories();
        $reports = $this->reportRepository->getLatestReports();
        return view('pages.app.home', compact('categories', 'reports'));
    }

}
