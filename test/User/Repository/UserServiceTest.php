<?php

namespace Test\Persona\Repository;

use Persona\User\Entity\User;
use Persona\User\Repository\UserService;
use PHPUnit\Framework\Assert;
use Test\Persona\PersonaTestCase;

class UserServiceTest extends PersonaTestCase
{

    public function testResolve()
    {
        $user = new User('foo', 'Foo Bar');
        $result = UserService::resolve()->addUser($user);
        Assert::assertTrue($result);
    }

    public function testResolveSameUserTwiceShouldReturnFalseOnSecondSave()
    {
        $user = new User('foo', 'Foo Bar');
        $result = UserService::resolve()->addUser($user);
        $secondAdd = UserService::resolve()->addUser($user);
        Assert::assertFalse($secondAdd);
    }

    public function testSearchUserByUsername()
    {
        $user = new User('foo', 'FooBar Name');

        UserService::resolve()->addUser($user);
        $userFromService = UserService::resolve()->getUserByUsername('foo');

        Assert::assertEquals('FooBar Name', $userFromService->getAlias());
    }

    public function testSearchInvalidUserByUsernameShouldThrownException()
    {
        try {
            UserService::resolve()->getUserByUsername('Invalid User');
            Assert::fail();
        } catch (\Persona\Exception\UserNotFoundException $e) {
            Assert::assertEquals($e->getMessage(), 'User "Invalid User" not found.');
        }
    }
}
