<?php

namespace Persona\User\UseCase;

use Persona\User\Entity\LoginResult;
use Persona\User\Entity\User;

interface UserService
{

    public function __construct(UserServiceResolver $void);

    public function createUser(User $user, string $password): bool;

    public function login(string $username, string $password): LoginResult;
}
