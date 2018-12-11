<?php

namespace Persona\Vault;

class Vault
{

    public static function encrypt(string $value, string $namespace): string
    {
        $salt = 'environment';
        $hash = "{$salt}{$value}{$namespace}";
        return hash('SHA256', $hash);
    }
}
