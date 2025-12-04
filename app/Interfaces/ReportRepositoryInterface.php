<?php

namespace App\Interfaces;

interface ReportRepositoryInterface{
    public function getAllReports();

    public function getLatestReports();
    public function getReportsByResident(int $residentId);
    public function getActiveReportsCountByResident(int $residentId);//untuk menghitung laporan aktif
    public function getCompletedReportsCountByResident(int $residentId);//untuk menghitung laporan selesai

    public function getReportsByResidentId(string $status);

    public function getReportById(int $id);


    public function getReportsByCategory(string $category);

    public function getReportByCode(string $code);

    public function createReport(array $data);

    public function updateReport(int $id, array $data);

    public function deleteReport(int $id);

    public function getReportsByResidentIdAndStatus(int $residentId, string $status);
}