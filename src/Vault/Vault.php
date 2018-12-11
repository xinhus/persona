<?php

namespace Persona\Vault;

class Vault
{

    public static function encrypt(string $value, string $namespace): string
    {
        $hash = self::getPasswordWithNamespace($value, $namespace);
        return password_hash($hash, PASSWORD_BCRYPT);
    }

    public static function verifyPassword(string $passwordHash, string $value, string $namespace): bool
    {
        $hash = self::getPasswordWithNamespace($value, $namespace);
        return password_verify($hash, $passwordHash);
    }

    protected static function getPasswordWithNamespace(string $value, string $namespace): string
    {
        return $hash = "{$value}{$namespace}";
    }
}
