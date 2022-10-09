<?php

namespace App\Repository\Implementations;

use App\Models\User;
use App\Repository\Interfaces\IUserRepository;

class UserRepository implements IUserRepository
{

    public function getUsersWithPaginate(): mixed
    {
        return User::paginate(2);
    }

    public function getUsersByCondition(array $condition): mixed
    {
        return User::where($condition);
    }
}
