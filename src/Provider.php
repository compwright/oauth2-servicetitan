<?php

namespace Compwright\OAuth2_Servicetitan;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class Provider extends AbstractProvider
{
    use BearerAuthorizationTrait;

    /**
     * Get authorization url to begin OAuth flow
     */
    public function getBaseAuthorizationUrl(): string
    {
        throw new UnsupportedFeatureException('Authorization code grant not supported');
    }

    /**
     * Get access token url to retrieve token
     */
    public function getBaseAccessTokenUrl(array $params): string
    {
        return 'https://auth.servicetitan.io/connect/token';
    }

    /**
     * Get provider url to fetch user details\
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token): string
    {
        throw new UnsupportedFeatureException('Resource owner not supported');
    }

    /**
     * Get the default scopes used by this provider.
     *
     * This should not be a complete list of all scopes, but the minimum
     * required for the provider user interface!
     */
    protected function getDefaultScopes(): array
    {
        return [];
    }

    /**
     * Check a provider response for errors.
     *
     * @throws IdentityProviderException
     * @param  ResponseInterface $response
     * @param  array $data Parsed response data
     */
    protected function checkResponse(ResponseInterface $response, $data): void
    {
        if (isset($data['type']) && $data['type'] === 'error') {
            throw new IdentityProviderException(
                $data['message'],
                $data['status'],
                $response
            );
        }

        // Handle Oauth2 Error
        if (isset($data['error'], $data['error_description'])) {
            throw new IdentityProviderException(
                $data['error_description'],
                $response->getStatusCode(),
                $response
            );
        }
    }

    /**
     * Generate a user object from a successful user details request.
     *
     * @param object $response
     * @param AccessToken $token
     * @return GenericResourceOwner
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new GenericResourceOwner($response);
    }
}
