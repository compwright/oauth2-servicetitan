# ServiceTitan Provider for OAuth 2.0 Client

[![Latest Version](https://img.shields.io/github/release/compwright/oauth2-servicetitan.svg?style=flat-square)](https://github.com/compwright/oauth2-servicetitan/releases)
[![Build Status](https://img.shields.io/travis/compwright/oauth2-servicetitan/master.svg?style=flat-square)](https://travis-ci.org/compwright/oauth2-servicetitan)
[![Total Downloads](https://img.shields.io/packagist/dt/compwright/oauth2-servicetitan.svg?style=flat-square)](https://packagist.org/packages/compwright/oauth2-servicetitan)

This package provides ServiceTitan OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

## Installation

To install, use composer:

```
composer require compwright/oauth2-servicetitan league/oauth2-client
```

## Usage

Usage is the same as The League's OAuth client, using `\Compwright\OAuth2_Servicetitan\Provider` as the provider.

> Note: for the ServiceTitan integration environment, use `\Compwright\OAuth2_Servicetitan\SandboxProvider` instead.

### Example: Authorization Code Flow

```php
$provider = new Compwright\OAuth2_Servicetitan\Provider([
    'clientId'      => '{servicetitan-client-id}',
    'clientSecret'  => '{servicetitan-client-secret}',
    'redirectUri'   => 'https://example.com/callback-url'
]);

// Get an access token using the authorization code grant
$token = $provider->getAccessToken('client_credentials');

// Use the token to interact with an API on the users behalf
echo $token->getToken();
```

## Testing

``` bash
$ composer run-script test
```

## Contributing

Please see [CONTRIBUTING](https://github.com/compwright/oauth2-servicetitan/blob/master/CONTRIBUTING.md) for details.


## Credits

- [Jonathon Hill](https://github.com/compwright), [CompWright Enterprises, LLC](https://compwright.com)


## License

The MIT License (MIT). Please see [License File](https://github.com/compwright/oauth2-servicetitan/blob/master/LICENSE) for more information.
