<?php

namespace App\Repository\Interfaces;


interface IUserRepository
{
    public function getUsersWithPaginate():mixed;

    public function getUsersByCondition(array $condition):mixed;
}
