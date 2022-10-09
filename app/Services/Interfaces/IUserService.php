<?php

namespace App\Services\Interfaces;

interface IUserService
{
    public function getUsersWithPaginate():mixed;

    public function getUsersByCondition(array $condition):mixed;
}
