<?php

namespace App\Services\Implementations;

use App\Models\User;
use App\Repository\Interfaces\IUserRepository;
use App\Services\Interfaces\IUserService;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $IUserRepository)
    {
        $this->userRepository = $IUserRepository;
    }

    public function getUsersWithPaginate(): mixed
    {
        return $this->userRepository->getUsersWithPaginate();
    }

    public function getUsersByCondition(array $condition): mixed
    {
        return $this->userRepository->getUsersByCondition($condition);
    }

    public function create(User $user): User
    {
       $user->password = Hash::make($user->password);
       return $this->userRepository->create($user);
    }

    public function update(User $user): User
    {
        $user->password = Hash::make($user->password);
        return $this->userRepository->update($user);
    }
    public function delete($id): bool
    {
        $user = $this->userRepository->getUsersByCondition(['id' => $id])->first();

       return $user->delete();
    }
}
