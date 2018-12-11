<?php

namespace Persona\User\UseCase;

use Persona\Token\Repository\TokenService;
use Persona\User\Entity\LoginResult;
use Persona\User\Entity\User;
use Persona\User\Exception\UserNotFoundException;
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

    public function login(string $username, string $password): LoginResult
    {
        try {
            $user = UserRepositoryResolver::resolve()->getUserByUsername($username);
        } catch (UserNotFoundException $exception) {
            return new LoginResult(false, '');
        }

        $success = Vault::verifyPassword($user->getPassword(), $password, 'User');
        if (!$success) {
            return new LoginResult(false, '');
        }

        $data = [
            'username' => $user->getUsername(),
            'userAlias' => $user->getAlias(),
        ];
        $token = TokenService::createToken($data, '+6 Hours');

        return new LoginResult($success, $token);
    }
}
