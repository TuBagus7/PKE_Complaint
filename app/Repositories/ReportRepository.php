<?php

namespace App\Repositories;

use App\Interfaces\ReportRepositoryInterface;
use App\Models\User;
use App\Models\Report;
use App\Models\ReportCategory;
use Auth;
use Illuminate\Database\Eloquent\Builder;
class ReportRepository implements ReportRepositoryInterface
{
    public function getAllReports()
    {
        return Report::all();
    }

    public function getReportsByResidentId(string $status)
{
    return Report::where('resident_id', Auth::user()->resident->id)
        ->whereHas('reportStatuses', function (Builder $query) use ($status) {
            $query->where('status', $status)
                ->whereIn('id', function ($subQuery) {
                    $subQuery->selectRaw('MAX(id)')
                        ->from('report_statuses')
                        ->groupBy('report_id');
                });
        })->get();
}



    public function getLatestReports()
    {
        return Report::latest()->get()->take(5);
    }

    public function getReportById(int $id)
    {
        return Report::find($id);
    }

    public function getReportByCode(string $code)
    {
        return Report::where('code', $code)->first();
    }

    public function getReportsByCategory(string $category)
    {
        $category = ReportCategory::where('name', $category)->first();
        return Report::where('report_category_id', $category->id)->get();
    }

    public function createReport(array $data)
    {
        $report =  Report::create($data);
        $report ->reportStatuses()->create([
            'status' => 'delivered',
            'description' => 'Laporan Berhasil Di Terima'
        ]);
        return $report;
    }

    public function updateReport(int $id, array $data)
    {
        $report = $this->getReportById($id);
        return $report->update($data);
    }


    public function deleteReport(int $id)
    {
        $report = $this->getReportById($id);
        return $report->delete();
    }
}