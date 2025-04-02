<?php

declare(strict_types=1);

namespace Compwright\OAuth2\Servicetitan;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class ServicetitanProviderTest extends TestCase
{
    public function testProduction(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client->expects($this->once())
            ->method('send')
            ->with($this->callback(function (RequestInterface $request): bool {
                $body = (string) $request->getBody();
                // var_dump($body);
                return (
                    'POST' === $request->getMethod() &&
                    ServicetitanProviderFactory::TOKEN_PRODUCTION === (string) $request->getUri() &&
                    'client_id=mock_client_id&client_secret=mock_secret&grant_type=client_credentials' === $body
                );
            }))
            ->willReturn(
                new Response(
                    200,
                    ['content-type' => 'application/json'],
                    '{"access_token":"mock_access_token"}'
                )
            );

        $provider = (new ServicetitanProviderFactory($client))->new();

        $token = $provider->getAccessToken('client_credentials', [
            'client_id' => 'mock_client_id',
            'client_secret' => 'mock_secret',
        ]);

        $this->assertEquals('mock_access_token', $token->getToken());
    }

    public function testEmbedded(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client->expects($this->once())
            ->method('send')
            ->with($this->callback(function (RequestInterface $request): bool {
                $body = (string) $request->getBody();
                // var_dump($body);
                return (
                    'POST' === $request->getMethod() &&
                    ServicetitanProviderFactory::TOKEN_PRODUCTION === (string) $request->getUri() &&
                    'client_id=mock_client_id&client_secret=mock_secret&grant_type=client_credentials' === $body
                );
            }))
            ->willReturn(
                new Response(
                    200,
                    ['content-type' => 'application/json'],
                    '{"access_token":"mock_access_token"}'
                )
            );

        $provider = (new ServicetitanProviderFactory($client))->new(
            clientId: 'mock_client_id',
            clientSecret: 'mock_secret'
        );

        $token = $provider->getAccessToken('client_credentials');

        $this->assertEquals('mock_access_token', $token->getToken());
    }

    public function testSandbox(): void
    {
        $client = $this->createMock(ClientInterface::class);
        $client->expects($this->once())
            ->method('send')
            ->with($this->callback(function (RequestInterface $request): bool {
                $body = (string) $request->getBody();
                // var_dump($body);
                return (
                    'POST' === $request->getMethod() &&
                    ServicetitanProviderFactory::TOKEN_SANDBOX === (string) $request->getUri() &&
                    'client_id=mock_client_id&client_secret=mock_secret&grant_type=client_credentials' === $body
                );
            }))
            ->willReturn(
                new Response(
                    200,
                    ['content-type' => 'application/json'],
                    '{"access_token":"mock_access_token"}'
                )
            );

        $provider = (new ServicetitanProviderFactory($client))->new(sandbox: true);

        $token = $provider->getAccessToken('client_credentials', [
            'client_id' => 'mock_client_id',
            'client_secret' => 'mock_secret',
        ]);

        $this->assertEquals('mock_access_token', $token->getToken());
    }
}
