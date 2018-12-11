<?php

namespace Persona\User\UseCase;

class UserServiceResolver
{
    private static $instance;

    private function __construct()
    {
    }

    public static function resolve(): UserService
    {
        return self::$instance ?? self::$instance = new UserServiceFacade(new self());
    }
}
