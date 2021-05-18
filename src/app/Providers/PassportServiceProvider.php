<?php


namespace App\Providers;


use App\Repositories\IdentityRepository;
use App\Repositories\ScopeRepository;
use League\OAuth2\Server\AuthorizationServer;
use OpenIDConnectServer\ClaimExtractor;
use OpenIDConnectServer\IdTokenResponse;

class PassportServiceProvider extends \Laravel\Passport\PassportServiceProvider
{
    public function makeAuthorizationServer()
    {
        $responseType = new IdTokenResponse(new IdentityRepository(), new ClaimExtractor());

        return new AuthorizationServer(
            $this->app->make(\Laravel\Passport\Bridge\ClientRepository::class),
            $this->app->make(\Laravel\Passport\Bridge\AccessTokenRepository::class),
            $this->app->make(ScopeRepository::class),
            $this->makeCryptKey('private'),
            app('encrypter')->getKey(),
            $responseType
        );
    }
}
