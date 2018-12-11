<?php

namespace Persona\User\Repository;

class UserRepositoryResolverForTest extends UserRepositoryResolver
{
    public static function reset(): void
    {
        self::$instance = null;
    }
}
