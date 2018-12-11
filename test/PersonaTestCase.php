<?php

namespace Test\Persona;

use Persona\User\Repository\UserRepositoryResolverForTest;
use PHPUnit\Framework\TestCase;

class PersonaTestCase extends TestCase
{

    /**
     * @before
     */
    public function cleanUserRepository()
    {
        UserRepositoryResolverForTest::reset();
    }
}
