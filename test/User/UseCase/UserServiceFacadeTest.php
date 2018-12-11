<?php

namespace Test\Persona\User\UseCase;

use Persona\Token\Repository\TokenService;
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
        $username = 'foo';
        $userAlias = 'bar';

        $user = new User($username, $userAlias);
        UserServiceResolver::resolve()->createUser($user, $password);
        $userFromRepository = UserRepositoryResolver::resolve()->getUserByUsername($username);

        Assert::assertEquals($username, $userFromRepository->getUsername());
        Assert::assertEquals($userAlias, $userFromRepository->getAlias());
        $passwordResult = Vault::verifyPassword($userFromRepository->getPassword(), $password, 'User');
        Assert::assertTrue($passwordResult);
    }

    public function testLoginWithValidPasswordShouldReturnTrue()
    {
        $password = 'password';
        $username = 'username';
        $alias = 'Alias';

        $user = new User($username, $alias);
        UserServiceResolver::resolve()->createUser($user, $password);
        $result = UserServiceResolver::resolve()->login($username, $password);
        Assert::assertTrue($result->isSuccess());
        Assert::assertTrue(TokenService::isValidToken($result->getToken()));
    }

    public function testLoginWithInvalidPasswordShouldReturnFalse()
    {
        $password = 'password';
        $username = 'username';
        $alias = 'Alias';

        $user = new User($username, $alias);
        UserServiceResolver::resolve()->createUser($user, $password);
        $result = UserServiceResolver::resolve()->login($username, 'passwordFake');
        Assert::assertFalse($result->isSuccess());
        Assert::assertFalse(TokenService::isValidToken($result->getToken()));
    }

    public function testLoginWithInvalidUsernameShouldReturnFalse()
    {
        $result = UserServiceResolver::resolve()->login('userNotFound', 'passwordFake');
        Assert::assertFalse($result->isSuccess());
        Assert::assertFalse(TokenService::isValidToken($result->getToken()));
    }
}
