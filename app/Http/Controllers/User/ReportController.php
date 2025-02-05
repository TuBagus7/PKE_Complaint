<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\ReportRepositoryInterface;

class ReportController extends Controller
{
    private ReportRepositoryInterface $reportRepository;
    public function __construct(

        ReportRepositoryInterface $reportRepository,
    )
    {
        $this->reportRepository = $reportRepository;
    }


    public function index(){
        $reports = $this->reportRepository->getAllReports();
        return view('pages.app.report.index', compact('reports'));
    }
    public function show($code){
        $report = $this->reportRepository->getReportByCode($code);
        return view('pages.app.report.show', compact('report'));
    }
}
