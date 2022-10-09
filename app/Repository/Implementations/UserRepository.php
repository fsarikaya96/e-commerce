<?php

namespace App\Repository\Implementations;

use App\Models\User;
use App\Repository\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{

    public function getUsersWithPaginate(): mixed
    {
        return User::paginate(10);
    }

    public function getUsersByCondition(array $condition): mixed
    {
        return User::where($condition);
    }

    public function create(User $user): User
    {
        $user->save();

        return $user;
    }

    public function update(User $user): User
    {
        $user->save();

        return $user;
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }

}
