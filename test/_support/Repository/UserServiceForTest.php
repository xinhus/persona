<?php

namespace Persona\Repository;

class UserServiceForTest extends UserService
{
    public static function reset(): void
    {
        self::$instance = null;
    }
}
