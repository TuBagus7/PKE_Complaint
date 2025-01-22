<?php

namespace App\Interfaces;

interface ResidentRepositoryInterface{
    public function getAllResidents();

    public function getResidentsById(int $id);

    public function createResident(array $data);

    public function updateResident(int $id, array $data);

    public function deleteResident(int $id);
}