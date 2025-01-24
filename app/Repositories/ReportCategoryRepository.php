<?php

namespace App\Repositories;

use App\Interfaces\ReportCategoryRepositoryInterface;
use App\Models\User;
use App\Models\ReportCategory;
class ReportCategoryRepository implements ReportCategoryRepositoryInterface
{
    public function getAllReportCategories()
    {
        return ReportCategory::all();
    }

public function getReportCategoryById(int $id)
{
    return ReportCategory::find($id);
}


    public function createReportCategory(array $data)
    {
        return ReportCategory::create($data);
    }

    public function updateReportCategory(int $id, array $data)
    {
        $reportCategory = $this->getReportCategoryById($id);
        return $reportCategory->update($data);
    }


    public function deleteReportCategory(int $id)
    {
        $reportCategory = $this->getReportCategoryById($id);

        
        return $reportCategory->delete();
    }
}