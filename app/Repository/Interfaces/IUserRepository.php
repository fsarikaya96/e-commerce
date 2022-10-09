<?php

namespace App\Repository\Interfaces;

use App\Models\User;

interface IUserRepository
{
    public function getUsersWithPaginate():mixed;

    public function getUsersByCondition(array $condition):mixed;

    public function create(User $user):User;

    public function update(User $user):User;

    public function delete(User $user):bool;
}
