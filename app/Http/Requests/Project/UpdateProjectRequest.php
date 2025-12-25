<?php

namespace App\Http\Requests\Project;

use App\Constants\ProjectConstant;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:' . implode(',', ProjectConstant::STATUSES),
            'pm_id' => 'required|exists:users,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'members' => 'nullable|array',
            'members.*' => 'exists:users,id',
        ];
    }
}
