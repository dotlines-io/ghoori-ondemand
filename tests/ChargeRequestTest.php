<?php /** @noinspection PhpComposerExtensionStubsInspection */

/** @noinspection SpellCheckingInspection */
/** @noinspection MethodVisibilityInspection */

namespace Dotlines\GhooriOnDemand\Tests;

use Dotlines\Ghoori\AccessTokenRequest;
use Dotlines\GhooriOnDemand\ChargeRequest;
use PHPUnit\Framework\TestCase;

class ChargeRequestTest extends TestCase
{
    public string $serverUrl = 'https://sb-payments.ghoori.com.bd';
    public string $tokenUrl = 'https://sb-payments.ghoori.com.bd/oauth/token';
    public string $username = 'someUser@gmail.com';
    public string $password = 'Nopass1234';
    public int $clientID = 27;
    public string $clientSecret = 'HmlIb5kqJnA9N9c79E8WzgZ6Hsoh1d5oyMbNruAw';

    /**
     * @test
     */
    final public function it_can_fetch_charge_url(): void
    {
        $accessTokenRequest = AccessTokenRequest::getInstance($this->tokenUrl, $this->username, $this->password, $this->clientID, $this->clientSecret);
        $tokenResponse = $accessTokenRequest->send();

        $accessToken = $tokenResponse['access_token'];

        $chargeUrl = $this->serverUrl . "/api/v2.0/charge";
        $orderID = 'test-app-' . random_int(111111, 999999);
        $package = 'BBC_Janala_Course1';
        $amount = random_int(10, 100);
        $callBackURL = 'https://test-app.local';
        $details = 'Test Transaction'; //optional
        $mobile = ''; //optional
        $email = ''; //optional
        $reference = ''; //optional
        $chargeRequest = ChargeRequest::getInstance($chargeUrl, $accessToken, $this->clientID, $orderID, $package, $amount, $callBackURL, $details, $mobile, $email, $reference);

        $chargeResponse = $chargeRequest->send();

        self::assertNotEmpty($chargeResponse);
        self::assertArrayHasKey('url', $chargeResponse);
        self::assertArrayHasKey('spTransID', $chargeResponse);
        self::assertArrayHasKey('errorCode', $chargeResponse);
        self::assertArrayHasKey('errorMessage', $chargeResponse);
        self::assertNotEmpty($chargeResponse['url']);
        self::assertNotEmpty($chargeResponse['spTransID']);
        self::assertNotEmpty($chargeResponse['errorCode']);
        self::assertNotEmpty($chargeResponse['errorMessage']);
    }


    /**
     * @test
     */
    final public function it_gets_exception_with_wrong_serverUrl(): void
    {
        $accessTokenRequest = AccessTokenRequest::getInstance($this->tokenUrl, $this->username, $this->password, $this->clientID, $this->clientSecret);
        $tokenResponse = $accessTokenRequest->send();

        $accessToken = $tokenResponse['access_token'];

        $chargeUrl = $this->serverUrl . "/api/v2.0/charge";
        $orderID = 'test-app-' . random_int(111111, 999999);
        $package = 'BBC_Janala_Course1';
        $amount = random_int(10, 100);
        $callBackURL = 'https://test-app.local';
        $details = 'Test Transaction'; //optional
        $mobile = ''; //optional
        $email = ''; //optional
        $reference = ''; //optional
        $chargeRequest = ChargeRequest::getInstance($chargeUrl, $accessToken, $this->clientID, $orderID, $package, $amount, $callBackURL, $details, $mobile, $email, $reference);
        $chargeResponse = $chargeRequest->send();

        self::assertNotEmpty($chargeResponse);
        self::assertArrayHasKey('url', $chargeResponse);
        self::assertArrayHasKey('spTransID', $chargeResponse);
        self::assertArrayHasKey('errorCode', $chargeResponse);
        self::assertArrayHasKey('errorResponse', $chargeResponse);
        self::assertNotEmpty($chargeResponse['url']);
        self::assertNotEmpty($chargeResponse['spTransID']);
        self::assertNotEmpty($chargeResponse['errorCode']);
        self::assertNotEmpty($chargeResponse['errorResponse']);
    }
}
