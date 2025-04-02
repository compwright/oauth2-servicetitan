<?php

declare(strict_types=1);

namespace Compwright\OAuth2\Servicetitan;

use League\OAuth2\Client\Grant\ClientCredentials;

class EnterpriseClientCredentials extends ClientCredentials
{
    /**
     * @return string[]
     */
    protected function getRequiredRequestParameters()
    {
        return [
            ...parent::getRequiredRequestParameters(),
            'tenant'
        ];
    }
}
