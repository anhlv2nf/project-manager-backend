<?php

namespace App\Models;

use App\Constants\ProjectConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'role',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Projects where this user is a PM
     */
    public function projectsManaged(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_user')
                    ->wherePivot('role_in_project', ProjectConstant::ROLE_MANAGER)
                    ->withPivot('role_in_project')
                    ->withTimestamps();
    }

    /**
     * Projects where this user is a member
     */
    public function projectsJoined(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_user')
                    ->withPivot('role_in_project')
                    ->withTimestamps();
    }
}
