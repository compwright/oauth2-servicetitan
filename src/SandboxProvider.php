<?php

namespace Compwright\OAuth2_Servicetitan;

class SandboxProvider extends Provider
{
    /**
     * Get access token url to retrieve token
     */
    public function getBaseAccessTokenUrl(array $params): string
    {
        return 'https://auth-integration.servicetitan.io/connect/token';
    }
}
