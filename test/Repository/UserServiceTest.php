<?php

namespace Test\Persona\Repository;

use Persona\Entity\User;
use Persona\Repository\UserService;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
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
