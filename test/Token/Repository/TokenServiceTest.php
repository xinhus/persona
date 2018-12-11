<?php

namespace Test\Persona\Token\Repository;

use Lcobucci\JWT\Parser;
use Persona\Token\Repository\TokenService;
use PHPUnit\Framework\Assert;
use Test\Persona\PersonaTestCase;

class TokenServiceTest extends PersonaTestCase
{
    public function testCreateTokenShouldRespectExpiryTime()
    {
        $token = TokenService::createToken([
            'foo' => 'bar'
        ], '+1 day');

        $tokenGenerated = (new Parser())->parse($token);

        $now = new \DateTime('now', new \DateTimeZone('UTC'));
        Assert::assertTrue($tokenGenerated->isExpired((clone $now)->modify('+2 day')));
        Assert::assertFalse($tokenGenerated->isExpired((clone $now)->modify('+23 hour')));
    }

    public function testOnValidateAnExpiredTokenShouldReturnAsInvalid()
    {
        $token = TokenService::createToken([
            'foo' => 'bar'
        ], '-1 day');

        Assert::assertFalse(TokenService::isValidToken($token));
    }

    public function testOnValidateAnModifiedTokenShouldReturnAsInvalid()
    {
        $token = TokenService::createToken([
            'foo' => 'bar'
        ], '+1 day');

        Assert::assertTrue(TokenService::isValidToken($token));

        $token .= 'invalidSignature';
        Assert::assertFalse(TokenService::isValidToken($token));
    }
}
