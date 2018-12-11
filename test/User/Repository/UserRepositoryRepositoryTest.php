<?php

namespace Test\Persona\Repository;

use Persona\User\Entity\User;
use Persona\User\Repository\UserRepositoryResolver;
use PHPUnit\Framework\Assert;
use Test\Persona\PersonaTestCase;

class UserRepositoryRepositoryTest extends PersonaTestCase
{

    public function testResolve()
    {
        $user = new User('foo', 'Foo Bar');
        $result = UserRepositoryResolver::resolve()->addUser($user);
        Assert::assertTrue($result);
    }

    public function testResolveSameUserTwiceShouldReturnFalseOnSecondSave()
    {
        $user = new User('foo', 'Foo Bar');
        $result = UserRepositoryResolver::resolve()->addUser($user);
        $secondAdd = UserRepositoryResolver::resolve()->addUser($user);
        Assert::assertFalse($secondAdd);
    }

    public function testSearchUserByUsername()
    {
        $user = new User('foo', 'FooBar Name');

        UserRepositoryResolver::resolve()->addUser($user);
        $userFromService = UserRepositoryResolver::resolve()->getUserByUsername('foo');

        Assert::assertEquals('FooBar Name', $userFromService->getAlias());
    }

    public function testSearchInvalidUserByUsernameShouldThrownException()
    {
        try {
            UserRepositoryResolver::resolve()->getUserByUsername('Invalid User');
            Assert::fail();
        } catch (\Persona\User\Exception\UserNotFoundException $e) {
            Assert::assertEquals($e->getMessage(), 'User "Invalid User" not found.');
        }
    }
}
