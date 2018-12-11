<?php

namespace Persona\User\Entity;

class LoginResult
{

    private $success;
    private $token;

    public function __construct(bool $success, ?string $token)
    {
        $this->success = $success;
        $this->token = $token ?? '';
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getToken(): string
    {
        return $this->token;
    }


}
