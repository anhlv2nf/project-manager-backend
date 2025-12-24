<?php

namespace App\Http\Requests\User;

use App\Constants\UserConstant;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'nullable|string|max:20',
            'role' => 'required|in:' . implode(',', UserConstant::ROLES),
            'status' => 'required|in:' . implode(',', UserConstant::STATUSES),
            'password' => 'required|string|min:8',
        ];
    }
}
