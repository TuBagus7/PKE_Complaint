<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\ReportCategoryRepositoryInterface;
use App\Interfaces\ReportRepositoryInterface;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    private ReportRepositoryInterface $reportRepository;
    private ReportCategoryRepositoryInterface $reportCategoryRepository;

    public function __construct(

        ReportRepositoryInterface $reportRepository,
        ReportCategoryRepositoryInterface $reportCategoryRepository
    )
    {
        $this->reportCategoryRepository = $reportCategoryRepository;
        $this->reportRepository = $reportRepository;
    }

    public function index()
    {
        $categories = $this->reportCategoryRepository->getAllReportCategories();
        $reports = $this->reportRepository->getReportsByResident(Auth::user()->resident->id);
        return view('pages.app.home', compact('categories', 'reports'));
    }

}
