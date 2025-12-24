<?php

namespace App\Repositories\Interfaces;

interface IUserRepository extends IBaseRepository
{
    public function findByEmail(string $email): ?\App\Models\User;
}
