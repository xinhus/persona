<?php

namespace Persona\Repository;

class UserService
{
    private static $instance;

    public static function resolve(): UserRepository
    {
        return self::$instance ?? self::$instance = new UserRepositoryInMemory();
    }
}
