<?php

namespace App\Interfaces;

interface ReportRepositoryInterface{
    public function getAllReports();

    public function getLatestReports();

    public function getReportById(int $id);

    public function createReport(array $data);

    public function updateReport(int $id, array $data);

    public function deleteReport(int $id);
}