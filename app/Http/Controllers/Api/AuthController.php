<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Services\Interfaces\IAuthService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use ApiResponseTrait;

    protected IAuthService $authService;

    public function __construct(IAuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * User Login
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $result = $this->authService->login($request->validated());
            return $this->successResponse($result, 'Đăng nhập thành công');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

    /**
     * User Logout
     */
    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user());
        return $this->successResponse(null, 'Đăng xuất thành công');
    }

    /**
     * Change Password
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        try {
            $this->authService->changePassword($request->user(), $request->validated());
            return $this->successResponse(null, 'Đổi mật khẩu thành công');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

    /**
     * Get Current User Profile
     */
    public function me(Request $request): JsonResponse
    {
        return $this->successResponse($request->user());
    }
}
