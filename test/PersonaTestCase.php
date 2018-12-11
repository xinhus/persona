<?php

namespace Test\Persona;

use Persona\User\Repository\UserServiceForTest;
use PHPUnit\Framework\TestCase;

class PersonaTestCase extends TestCase
{

    /**
     * @before
     */
    public function cleanUserRepository()
    {
        UserServiceForTest::reset();
    }
}
