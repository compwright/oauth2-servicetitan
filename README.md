# ServiceTitan Provider for OAuth 2.0 Client

[![Latest Version](https://img.shields.io/github/release/compwright/oauth2-servicetitan.svg?style=flat-square)](https://github.com/compwright/oauth2-servicetitan/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/compwright/oauth2-servicetitan.svg?style=flat-square)](https://packagist.org/packages/compwright/oauth2-servicetitan)

This package provides ServiceTitan OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

## Installation

To install, use composer:

```
composer require compwright/oauth2-servicetitan league/oauth2-client
```

## Usage

Create the provider instance using the `\Compwright\OAuth2\Servicetitan\ServicetitanProviderFactory` factory class.

### Example: Authorization Code Flow

```php
$factory = new Compwright\OAuth2\Servicetitan\ServicetitanProviderFactory();
$provider = $factory->new(
    clientId: null,     // optional, recommended to pass as an option to getAccessToken()
    clientSecret: null, // optional, recommended to pass as an option to getAccessToken()
    sandbox: false,     // enable for sandbox environment
    enterprise: false   // enable for Enterprise Hub clients
);

// Get an access token using the authorization code grant
$token = $provider->getAccessToken('client_credentials', [
    'client_id'     => '{servicetitan-client-id}',
    'client_secret' => '{servicetitan-client-secret}',

    // required for Enterprise Hub clients:
    'tenant'        => '{servicetitan-tenant-id}',
]);

// Use the token to interact with an API on the users behalf
echo $token->getToken();
```

## Testing

``` bash
$ make test
```

## Contributing

Please see [CONTRIBUTING](https://github.com/compwright/oauth2-servicetitan/blob/master/CONTRIBUTING.md) for details.


## Credits

- [Jonathon Hill](https://github.com/compwright), [CompWright Enterprises, LLC](https://compwright.com)


## License

The MIT License (MIT). Please see [License File](https://github.com/compwright/oauth2-servicetitan/blob/master/LICENSE) for more information.
