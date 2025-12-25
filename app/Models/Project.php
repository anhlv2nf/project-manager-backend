<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'pm_id',
        'start_date',
        'end_date',
    ];

    /**
     * Get the PM of the project
     */
    public function pm(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pm_id');
    }

    /**
     * Get the members of the project
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user')
                    ->withPivot('role_in_project')
                    ->withTimestamps();
    }
}
