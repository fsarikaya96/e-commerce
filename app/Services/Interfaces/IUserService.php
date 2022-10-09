<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface IUserService
{
    public function getUsersWithPaginate():mixed;

    public function getUsersByCondition(array $condition):mixed;

    public function create(User $user):User;

    public function update(User $user):User;

    public function delete($id):bool;
}
