<?php

namespace Persona\User\Repository;

use Persona\User\Entity\User;

interface UserRepository
{
    public function addUser(User $user): bool;

    public function getUserByUsername(string $username): User;
}
