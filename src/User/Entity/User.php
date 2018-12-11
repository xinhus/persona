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

    public static function createUserWithPassword(User $user, string $password): self
    {
        $instance = new self($user->getUsername(), $user->getAlias());
        $instance->password = $password;
        return $instance;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
