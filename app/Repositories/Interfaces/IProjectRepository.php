<?php

namespace App\Repositories\Interfaces;

interface IProjectRepository extends IBaseRepository
{
    public function syncMembers(int $projectId, array $memberIds): void;
}
