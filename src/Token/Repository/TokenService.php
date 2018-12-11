<?php

namespace Persona\Token\Repository;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class TokenService
{
    public static function createToken(array $data, string $expiry_in): string
    {
        $tokenBuilder = self::createTokenBuilder();
        $tokenBuilder = self::updateDates($expiry_in, $tokenBuilder);
        $tokenBuilder = self::updateData($data, $tokenBuilder);
        $tokenBuilder = self::signToken($tokenBuilder);
        return $tokenBuilder->getToken();
    }

    public static function isValidToken(string $token): bool
    {
        try {
            $token = (new Parser())->parse($token);
        } catch (\InvalidArgumentException|\RuntimeException $exception) {
            return false;
        }
        $signer = self::getSigner();
        return $token->verify($signer, self::getSecretKey()) && !$token->isExpired();
    }

    protected static function createTokenBuilder(): Builder
    {
        return (new Builder())->setIssuer('Persona');
    }

    protected static function updateDates(string $expiry_in, Builder $tokenBuilder): Builder
    {
        $issuedAt = (new \DateTime('now', new \DateTimeZone('UTC')))->getTimestamp();
        $expiryAt = (new \DateTime($expiry_in, new \DateTimeZone('UTC')))->getTimestamp();
        $tokenBuilder = $tokenBuilder->setIssuedAt($issuedAt);
        return $tokenBuilder->setExpiration($expiryAt);
    }

    protected static function updateData(array $data, Builder $tokenBuilder): Builder
    {
        foreach ($data as $key => $value) {
            $tokenBuilder = $tokenBuilder->set($key, $value);
        }
        return $tokenBuilder;
    }

    protected static function signToken(Builder $tokenBuilder): Builder
    {
        $signer = self::getSigner();
        $tokenBuilder = $tokenBuilder->sign($signer, self::getSecretKey());
        return $tokenBuilder;
    }

    protected static function getSigner(): Signer
    {
        return new Sha256();
    }

    protected static function getSecretKey(): string
    {
        return 'myprivatekey';
    }
}
