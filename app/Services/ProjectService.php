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
        // Load relationships to avoid N+1
        return Project::with(['pm', 'members'])->get();
    }

    public function getProjectById(int $id): Project
    {
        return Project::with(['pm', 'members'])->findOrFail($id);
    }

    public function createProject(array $data): Project
    {
        return DB::transaction(function () use ($data) {
            $project = $this->projectRepository->create($data);
            
            if (isset($data['members']) && is_array($data['members'])) {
                $this->projectRepository->syncMembers($project->id, $data['members']);
            }
            
            return $project->load(['pm', 'members']);
        });
    }

    public function updateProject(int $id, array $data): Project
    {
        return DB::transaction(function () use ($id, $data) {
            $project = $this->projectRepository->update($id, $data);
            
            if (isset($data['members']) && is_array($data['members'])) {
                $this->projectRepository->syncMembers($id, $data['members']);
            }
            
            return $project->load(['pm', 'members']);
        });
    }

    public function deleteProject(int $id): bool
    {
        return $this->projectRepository->delete($id);
    }
}
