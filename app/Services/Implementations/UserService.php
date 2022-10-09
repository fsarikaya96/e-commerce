<?php

namespace App\Services\Implementations;

use App\Repository\Interfaces\IUserRepository;
use App\Services\Interfaces\IUserService;

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
}
