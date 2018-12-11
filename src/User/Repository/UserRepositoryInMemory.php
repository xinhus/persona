<?php

namespace Persona\User\Repository;

use Persona\User\Entity\User;
use Persona\User\Exception\UserNotFoundException;

class UserRepositoryInMemory implements UserRepository
{

    /** @var User[] */
    private $users = [];

    public function __construct(UserRepositoryResolver $void)
    {
    }

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
                return User::createUserWithPassword($user, $user->getPassword());
            }
        }
        throw new UserNotFoundException("User \"{$username}\" not found.");
    }
}
