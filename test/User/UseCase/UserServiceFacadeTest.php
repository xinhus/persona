<?php

namespace Test\Persona\User\UseCase;

use Persona\User\Entity\User;
use Persona\User\Repository\UserRepositoryResolver;
use Persona\User\UseCase\UserServiceResolver;
use Persona\Vault\Vault;
use PHPUnit\Framework\Assert;
use Test\Persona\PersonaTestCase;

class UserServiceFacadeTest extends PersonaTestCase
{
    public function testCreateUser()
    {
        $password = 'myfakepassword';
        $passwordEncrypted = Vault::encrypt($password, 'User');
        $username = 'foo';
        $userAlias = 'bar';
        $user = new User($username, $userAlias);

        UserServiceResolver::resolve()->createUser($user, $password);
        $userFromRepository = UserRepositoryResolver::resolve()->getUserByUsername($username);

        Assert::assertEquals($username, $userFromRepository->getUsername());
        Assert::assertEquals($userAlias, $userFromRepository->getAlias());
        Assert::assertEquals($passwordEncrypted, $userFromRepository->getPassword());
    }
}
