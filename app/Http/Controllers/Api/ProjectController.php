<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Services\Interfaces\IProjectService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    use ApiResponseTrait;

    protected IProjectService $projectService;

    public function __construct(IProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index(): JsonResponse
    {
        $projects = $this->projectService->getAllProjects();
        return $this->successResponse($projects, 'Lấy danh sách dự án thành công');
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = $this->projectService->createProject($request->validated());
        return $this->successResponse($project, 'Tạo dự án thành công', 201);
    }

    public function show(string $id): JsonResponse
    {
        $project = $this->projectService->getProjectById((int)$id);
        return $this->successResponse($project);
    }

    public function update(UpdateProjectRequest $request, string $id): JsonResponse
    {
        $project = $this->projectService->updateProject((int)$id, $request->validated());
        return $this->successResponse($project, 'Cập nhật dự án thành công');
    }

    public function destroy(string $id): JsonResponse
    {
        $this->projectService->deleteProject((int)$id);
        return $this->successResponse(null, 'Xóa dự án thành công');
    }
}
