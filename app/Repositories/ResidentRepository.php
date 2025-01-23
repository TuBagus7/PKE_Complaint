<?php

namespace App\Repositories;

use App\Interfaces\ResidentRepositoryInterface;
use App\Models\Resident;
use App\Models\User;

class ResidentRepository implements ResidentRepositoryInterface
{
    public function getAllResidents()
    {
        return Resident::all();
    }

    public function getResidentsById(int $id)
    {
        return Resident::find('id', $id)->first();  
    }

    public function createResident(array $data)
    {
        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password'])
        ]);

        return $user->resident()->create($data);
    }

    public function updateResident(int $id, array $data)
    {
        $resident = $this->getResidentsById($id);
        return $resident->update($data);
    }


    public function deleteResident(int $id)
    {
        $resident = $this->getResidentsById($id);
        return $resident->delete();
    }
}