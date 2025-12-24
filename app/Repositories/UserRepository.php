<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;

class UserRepository extends BaseRepository implements IUserRepository
{
    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }
}
