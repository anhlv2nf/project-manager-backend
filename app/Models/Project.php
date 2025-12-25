<?php

namespace App\Models;

use App\Constants\ProjectConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'start_date',
        'end_date',
    ];

    /**
     * Get all users associated with the project
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user')
                    ->withPivot('role_in_project')
                    ->withTimestamps();
    }

    /**
     * Get the managers of the project
     */
    public function managers(): BelongsToMany
    {
        return $this->users()->wherePivot('role_in_project', ProjectConstant::ROLE_MANAGER);
    }

    /**
     * Get the members (non-managers) of the project
     */
    public function members(): BelongsToMany
    {
        return $this->users()->wherePivot('role_in_project', ProjectConstant::ROLE_MEMBER);
    }
}
