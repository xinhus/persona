<?php

namespace Persona\User\Repository;

class UserService
{
    protected static $instance;

    public static function resolve(): UserRepository
    {
        return self::$instance ?? self::$instance = new UserRepositoryInMemory();
    }
}
