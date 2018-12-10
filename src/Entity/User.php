<?php

namespace Persona\Entity;

class User
{
    private $username;
    private $alias;

    public function __construct(string $username, string $alias)
    {
        $this->username = $username;
        $this->alias = $alias;
    }


    public function getUsername(): string
    {
        return $this->username;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }
}
