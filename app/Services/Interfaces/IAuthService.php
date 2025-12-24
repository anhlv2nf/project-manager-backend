<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface IAuthService
{
    public function login(array $credentials): array;
    public function logout(User $user): bool;
    public function changePassword(User $user, array $data): bool;
}
