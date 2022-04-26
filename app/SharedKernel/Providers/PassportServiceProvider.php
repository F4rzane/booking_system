<?php

namespace App\SharedKernel\Providers;

use Laravel\Passport\PassportServiceProvider as BasePassportServiceProvider;

use Laravel\Passport\Bridge;
use Laravel\Passport\Passport;
use League\OAuth2\Server\AuthorizationServer;
use App\SharedKernel\Responses\BearerTokenResponse;
use Illuminate\Contracts\Container\BindingResolutionException;

class PassportServiceProvider extends BasePassportServiceProvider
{
    /**
     * Make the authorization service instance.
     *
     * @return AuthorizationServer
     * @throws BindingResolutionException
     */
    public function makeAuthorizationServer(): AuthorizationServer
    {
        return new AuthorizationServer(
            $this->app->make(Bridge\ClientRepository::class),
            $this->app->make(Bridge\AccessTokenRepository::class),
            $this->app->make(Bridge\ScopeRepository::class),
            $this->makeCryptKey('private'),
            app('encrypter')->getKey(),
            new BearerTokenResponse()
        );
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Passport::loadKeysFrom(storage_path('./secrets/oauth'));
        Passport::hashClientSecrets();
    }
}
