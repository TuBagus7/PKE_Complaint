<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\ReportRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private ReportRepositoryInterface $reportRepository;

    public function __construct(ReportRepositoryInterface $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function index()
    {
        //Minta data ke Repository
        $activeReports = $this->reportRepository->getActiveReportsCountByResident(Auth::user()->resident->id);
        $completedReports = $this->reportRepository->getCompletedReportsCountByResident(Auth::user()->resident->id);
        
        //Kirim data ke view
        return view('pages.app.profile', compact('activeReports', 'completedReports'));
    }
}
