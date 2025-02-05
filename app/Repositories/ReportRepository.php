<?php

namespace App\Repositories;

use App\Interfaces\ReportRepositoryInterface;
use App\Models\User;
use App\Models\Report;
use App\Models\ReportCategory;
class ReportRepository implements ReportRepositoryInterface
{
    public function getAllReports()
    {
        return Report::all();
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
        return Report::create($data);
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