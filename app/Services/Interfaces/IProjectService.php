<?php

namespace App\Services\Interfaces;

use App\Models\Project;
use Illuminate\Support\Collection;

interface IProjectService
{
    public function getAllProjects(): Collection;
    public function getProjectById(int $id): Project;
    public function createProject(array $data): Project;
    public function updateProject(int $id, array $data): Project;
    public function deleteProject(int $id): bool;
}
