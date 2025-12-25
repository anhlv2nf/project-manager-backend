<?php

namespace App\Repositories\Interfaces;

interface IProjectRepository extends IBaseRepository
{
    public function syncUsersWithRoles(int $projectId, array $usersWithRoles): void;
}
