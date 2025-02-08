<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Interfaces\ReportCategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Interfaces\ReportRepositoryInterface;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    private ReportRepositoryInterface $reportRepository;
    private ReportCategoryRepositoryInterface $reportCategoryRepository;
    public function __construct(

        ReportRepositoryInterface $reportRepository,
        ReportCategoryRepositoryInterface $reportCategoryRepository
    )
    {
        $this->reportRepository = $reportRepository;
        $this->reportCategoryRepository = $reportCategoryRepository;
    }


    public function index(Request $request){
        if ($request->category) {
        $reports = $this->reportRepository->getReportsByCategory($request->category);
        }else{
        $reports = $this->reportRepository->getAllReports();
        }
        return view('pages.app.report.index', compact('reports'));
    }
    public function show($code){
        $report = $this->reportRepository->getReportByCode($code);
        return view('pages.app.report.show', compact('report'));
    }

    public function take(){
        return view('pages.app.report.take');
    }

    public function preview(){
        return view('pages.app.report.preview');
    }

    public function create(){
        $categories = $this->reportCategoryRepository->getAllReportCategories();
        return view('pages.app.report.create', compact('categories'));
    }

    public function store(StoreReportRequest $request){
        $data = $request->validated();
        $data['code'] = 'PKE-LAPOR' . mt_rand(100000, 999999);
        $data['resident_id'] = Auth::user()->resident->id;
        $data['image'] = $request->file('image')->store('assets/report/image', 'public'); 
        $this->reportRepository->createReport($data);

        return redirect()->route('report.success');
    }
    
    public function success(){
        return view('pages.app.report.success');
    }
}
