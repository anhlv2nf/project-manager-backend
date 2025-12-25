<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\Interfaces\IProjectRepository;

class ProjectRepository extends BaseRepository implements IProjectRepository
{
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    public function syncUsersWithRoles(int $projectId, array $usersWithRoles): void
    {
        // $usersWithRoles example: [1 => ['role_in_project' => 'manager'], 2 => ['role_in_project' => 'member']]
        $project = $this->find($projectId);
        $project->users()->sync($usersWithRoles);
    }
}
