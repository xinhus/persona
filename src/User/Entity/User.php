<?php

namespace Persona\User\Entity;

class User
{
    private $username;
    private $alias;
    private $password = '';

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

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
