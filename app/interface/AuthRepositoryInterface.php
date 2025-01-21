<?php

namespace App\Interface;

interface AuthRepositoryInterface
{
    public function login(array $credentials);
}