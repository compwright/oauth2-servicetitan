<?php

declare(strict_types=1);

namespace Compwright\OAuth2\Servicetitan;

use GuzzleHttp\ClientInterface;
use League\OAuth2\Client\Provider\GenericProvider;

class ServicetitanProviderFactory
{
    public const TOKEN_PRODUCTION = 'https://auth.servicetitan.io/connect/token';
    public const TOKEN_SANDBOX = 'https://auth-integration.servicetitan.io/connect/token';

    public function __construct(private ?ClientInterface $httpClient = null)
    {
    }

    public function new(
        ?string $clientId = null,
        ?string $clientSecret = null,
        bool $enterprise = false,
        bool $sandbox = false
    ): GenericProvider {
        $provider = new GenericProvider([
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
            'urlAccessToken' => $sandbox ? self::TOKEN_SANDBOX : self::TOKEN_PRODUCTION,
            'urlAuthorize' => '',
            'urlResourceOwnerDetails' => '',
        ]);

        if ($enterprise) {
            $provider->getGrantFactory()->setGrant(
                'client_credentials',
                new EnterpriseClientCredentials()
            );
        }

        if ($this->httpClient) {
            $provider->setHttpClient($this->httpClient);
        }

        return $provider;
    }
}
