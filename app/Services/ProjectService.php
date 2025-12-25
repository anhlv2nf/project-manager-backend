<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\Interfaces\IProjectRepository;
use App\Services\Interfaces\IProjectService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProjectService implements IProjectService
{
    protected IProjectRepository $projectRepository;

    public function __construct(IProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getAllProjects(): Collection
    {
        return Project::with(['managers', 'members'])->get();
    }

    public function getProjectById(int $id): Project
    {
        return Project::with(['managers', 'members'])->findOrFail($id);
    }

    public function createProject(array $data): Project
    {
        return DB::transaction(function () use ($data) {
            $project = $this->projectRepository->create($data);
            
            if (isset($data['users']) && is_array($data['users'])) {
                $this->projectRepository->syncUsersWithRoles($project->id, $data['users']);
            }
            
            return $project->load(['managers', 'members']);
        });
    }

    public function updateProject(int $id, array $data): Project
    {
        return DB::transaction(function () use ($id, $data) {
            $project = $this->projectRepository->update($id, $data);
            
            if (isset($data['users']) && is_array($data['users'])) {
                $this->projectRepository->syncUsersWithRoles($id, $data['users']);
            }
            
            return $project->load(['managers', 'members']);
        });
    }

    public function deleteProject(int $id): bool
    {
        return $this->projectRepository->delete($id);
    }

    public function syncUsers(int $id, array $usersWithRoles): Project
    {
        return DB::transaction(function () use ($id, $usersWithRoles) {
            $this->projectRepository->syncUsersWithRoles($id, $usersWithRoles);
            return $this->getProjectById($id);
        });
    }
}
