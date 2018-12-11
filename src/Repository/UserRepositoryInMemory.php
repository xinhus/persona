<?php

namespace Persona\Repository;

use Persona\Entity\User;
use Persona\Exception\UserNotFoundException;

class UserRepositoryInMemory implements UserRepository
{

    /** @var User[] */
    private $users = [];

    public function addUser(User $user): bool
    {
        if (isset($this->users[$user->getUsername()])) {
            return false;
        }
        $this->users[$user->getUsername()] = $user;
        return true;
    }

    public function getUserByUsername(string $username): User
    {
        foreach ($this->users as $user) {
            if ($user->getUsername() === $username) {
                return $user;
            }
        }
        throw new UserNotFoundException("User \"{$username}\" not found.");
    }
}
