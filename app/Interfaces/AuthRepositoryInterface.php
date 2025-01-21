<?php

namespace App\Interfaces;


interface AuthRepositoryInterface
{
    public function login(array $credentials);
}