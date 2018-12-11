<?php

namespace Test\Persona\Entity;

use Persona\Entity\User;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testUser()
    {
        $username = 'foobar';
        $alias = 'my custom alias';
        $user = new User($username, $alias);
        Assert::assertEquals($username, $user->getUsername());
        Assert::assertEquals($alias, $user->getAlias());
    }

}
