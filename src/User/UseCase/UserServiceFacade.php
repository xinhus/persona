<?php

namespace Persona\User\UseCase;

use Persona\User\Entity\User;
use Persona\User\Repository\UserRepositoryResolver;
use Persona\Vault\Vault;

class UserServiceFacade implements UserService
{

    public function __construct(UserServiceResolver $void)
    {
    }

    public function createUser(User $user, string $password): bool
    {
        $passwordEncrypted = Vault::encrypt($password, 'User');
        $userToSave = User::createUserWithPassword($user, $passwordEncrypted);
        return UserRepositoryResolver::resolve()->addUser($userToSave);
    }
}
