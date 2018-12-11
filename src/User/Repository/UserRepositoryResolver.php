<?php

namespace Persona\User\Repository;

class UserRepositoryResolver
{

    protected static $instance;

    private function __construct()
    {
    }

    public static function resolve(): UserRepository
    {
        return self::$instance ?? self::$instance = new UserRepositoryInMemory(new self());
    }
}
