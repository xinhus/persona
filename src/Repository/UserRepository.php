<?php

namespace Persona\Repository;

use Persona\Entity\User;

interface UserRepository
{
    public function addUser(User $user): bool;

    public function getUserByUsername(string $username): User;
}
