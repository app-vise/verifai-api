<?php

namespace Tests\Integration;

use Appvise\Verifai\Exception\NotAuthenticatedException;
use Appvise\Verifai\Http\Body;
use Appvise\Verifai\Http\ClientInterface;
use Appvise\Verifai\Http\GuzzleClient;
use Appvise\Verifai\Http\SessionId;
use Appvise\Verifai\Model\OneTimePassword;
use Appvise\Verifai\VerifaiClient;
use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /** @test */
    public function it_should_fetch_an_access_token()
    {
        $stub = $this->createStub(ClientInterface::class);
        $stub->method('post')
            ->willReturn(new Response(200, [], '{
                "token": "1234567890",
                "expire": "05/29/2017 09:30:12 PM",
                "used": false
            }'));

        $client = new VerifaiClient($stub);
        $body = new Body('https://app.handelzeker.nl');
        $otp = $client->obtainOTP($body);
        $this->assertInstanceOf(OneTimePassword::class, $otp);
        $this->assertFalse($otp->hasBeenUsed());
        $this->assertEquals('1234567890', $otp->token());
        $this->assertEquals(DateTime::createFromFormat('d-m-y', '29-05-17')->format('d-m-y'), $otp->expires()->format('d-m-y'));
    }

    /** @test */
    public function it_should_throw_an_error_when_not_authenticated()
    {
        $this->expectException(NotAuthenticatedException::class);
        $mock = new MockHandler([
            new RequestException(
                'Not autenthicated',
                new Request('GET', '/'),
                new Response(401, [], '')
            ),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $client = new VerifaiClient(new GuzzleClient($client));
        $client->getVerifaiResult(new SessionId('fdasfsad'));
    }

    /** @test */
    public function it_should_delete_a_session()
    {
        $stub = $this->createStub(ClientInterface::class);
        $stub->method('delete')
            ->willReturn(new Response(200, [], null));

        $client = new VerifaiClient($stub);
        $session = new SessionId('session_id_found_via_websdk_frontend_callback');
        $response = $client->deleteSession($session);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
