<?php

namespace App\Repositories;

use App\Entities\ScopeEntity;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\Bridge\Scope;
use Laravel\Passport\Passport;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;

class ScopeRepository extends \Laravel\Passport\Bridge\ScopeRepository
{
    public static array $scopes = [
        'openid' => 'Enable OpenID Connect support',
        'profile' => 'Basic details about you',
        'email' => 'Your email address',
        'address' => 'Your address',
        'phone' => 'Your phone number',
    ];

    public function getScopeEntityByIdentifier($identifier): Scope|ScopeEntity|ScopeEntityInterface|null
    {
        if (!array_key_exists($identifier, static::$scopes)) {
            return parent::getScopeEntityByIdentifier($identifier);
        }

        $scope = new ScopeEntity();
        $scope->setIdentifier($identifier);

        return $scope;
    }
}
