<?php

namespace App\Http\Requests\Project;

use App\Constants\ProjectConstant;
use Illuminate\Foundation\Http\FormRequest;

class SyncProjectUsersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'users' => 'required|array',
            'users.*.user_id' => 'required|exists:users,id',
            'users.*.role_in_project' => 'required|in:' . implode(',', ProjectConstant::ROLES),
        ];
    }
}
