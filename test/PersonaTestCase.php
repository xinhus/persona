<?php

namespace Test\Persona;

use Persona\Repository\UserServiceForTest;
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
