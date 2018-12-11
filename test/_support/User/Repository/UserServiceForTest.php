<?php

namespace Persona\User\Repository;

class UserServiceForTest extends UserService
{
    public static function reset(): void
    {
        self::$instance = null;
    }
}
