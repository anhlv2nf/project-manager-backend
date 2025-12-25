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

    public function syncMembers(int $projectId, array $memberIds): void
    {
        $project = $this->find($projectId);
        $project->members()->sync($memberIds);
    }
}
