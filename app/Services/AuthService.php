<?php

namespace App\Services;

use App\Models\User;
use App\Services\Interfaces\IAuthService;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService implements IAuthService
{
    protected IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle user login and token generation
     */
    public function login(array $credentials): array
    {
        $user = $this->userRepository->findByEmail($credentials['email']);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Thông tin đăng nhập không chính xác.'],
            ]);
        }

        if ($user->status !== 'active') {
            throw ValidationException::withMessages([
                'email' => ['Tài khoản này đã bị khóa.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
    }

    /**
     * Handle user logout
     */
    public function logout(User $user): bool
    {
        return $user->tokens()->delete();
    }

    /**
     * Handle password change
     */
    public function changePassword(User $user, array $data): bool
    {
        if (!Hash::check($data['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Mật khẩu hiện tại không đúng.'],
            ]);
        }

        $user->password = $data['new_password'];
        return $user->save();
    }
}
