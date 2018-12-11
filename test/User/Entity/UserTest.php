<?php

namespace Test\Persona\Entity;

use Persona\User\Entity\User;
use PHPUnit\Framework\Assert;
use Test\Persona\PersonaTestCase;

class UserTest extends PersonaTestCase
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
