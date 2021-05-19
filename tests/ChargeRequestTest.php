<?php

/** @noinspection PhpComposerExtensionStubsInspection */
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

    public string $accessToken = "";
    public string $chargeUrl = "";
    public string $package = "";
    public string $callBackURL = "";
    public string $details = "";
    public string $mobile = ''; //optional
    public string $email = ''; //optional
    public string $reference = ''; //optional

    /**
     * @throws Exception
     */
    final public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $accessTokenRequest = AccessTokenRequest::getInstance($this->tokenUrl, $this->username, $this->password, $this->clientID, $this->clientSecret);
        $tokenResponse = $accessTokenRequest->send();

        $this->accessToken = (string)$tokenResponse['access_token'];

        $this->chargeUrl = $this->serverUrl . "/api/v2.0/charge";
        $this->package = 'BBC_Janala_Course1';
        $this->callBackURL = 'https://test-app.local';
        $this->details = 'Test Transaction'; //optional
    }


    /**
     * @test
     * @throws Exception
     */
    final public function it_can_fetch_charge_url(): void
    {
        $orderID = 'test-app-' . random_int(111111, 999999);
        $amount = random_int(10, 100);
        $chargeRequest = ChargeRequest::getInstance($this->chargeUrl, $this->accessToken, $this->clientID, $orderID, $this->package, $amount, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);

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
     * @throws Exception
     */
    final public function it_gets_exception_with_empty_serverUrl(): void
    {
        $orderID = 'test-app-' . random_int(111111, 999999);
        $amount = random_int(10, 100);
        $chargeRequest = ChargeRequest::getInstance("", $this->accessToken, $this->clientID, $orderID, $this->package, $amount, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);
        $this->expectException(Exception::class);
        $chargeRequest->send();
    }

    /**
     * @test
     * @throws Exception
     */
    final public function it_gets_exception_with_wrong_serverUrl(): void
    {
        $orderID = 'test-app-' . random_int(111111, 999999);
        $amount = random_int(10, 100);
        $chargeRequest = ChargeRequest::getInstance($this->chargeUrl."/wrong", $this->accessToken, $this->clientID, $orderID, $this->package, $amount, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);
        $this->expectException(ClientException::class);
        $chargeRequest->send();
    }

    /**
     * @test
     * @throws Exception
     */
    final public function it_gets_exception_with_empty_accesToken(): void
    {
        $orderID = 'test-app-' . random_int(111111, 999999);
        $amount = random_int(10, 100);
        $chargeRequest = ChargeRequest::getInstance($this->chargeUrl, "", $this->clientID, $orderID, $this->package, $amount, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);
        $this->expectException(ClientException::class);
        $chargeRequest->send();
    }

    /**
     * @test
     * @throws Exception
     */
    final public function it_gets_exception_with_wrong_accesToken(): void
    {
        $orderID = 'test-app-' . random_int(111111, 999999);
        $amount = random_int(10, 100);
        $chargeRequest = ChargeRequest::getInstance($this->chargeUrl, $this->accessToken."skfhksg", $this->clientID, $orderID, $this->package, $amount, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);
        $this->expectException(ClientException::class);
        $chargeRequest->send();
    }

    /**
     * @test
     * @throws Exception
     */
    final public function it_can_not_fetch_with_wrong_clientID(): void
    {
        $orderID = 'test-app-' . random_int(111111, 999999);
        $amount = random_int(10, 100);
        $chargeRequest = ChargeRequest::getInstance($this->chargeUrl, $this->accessToken, 99999, $orderID, $this->package, $amount, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);
        $chargeResponse = $chargeRequest->send();

        self::assertNotEmpty($chargeResponse);
        self::assertArrayNotHasKey('url', $chargeResponse);
        self::assertArrayNotHasKey('spTransID', $chargeResponse);
        self::assertArrayHasKey('errorCode', $chargeResponse);
        self::assertArrayHasKey('errorMessage', $chargeResponse);
        self::assertNotEmpty($chargeResponse['errorCode']);
        self::assertNotEmpty($chargeResponse['errorMessage']);
    }

    /**
     * @test
     * @throws Exception
     */
    final public function it_can_not_fetch_url_with_empty_orderID(): void
    {
        $amount = random_int(10, 100);
        $chargeRequest = ChargeRequest::getInstance($this->chargeUrl, $this->accessToken, $this->clientID, "", $this->package, $amount, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);
        $chargeResponse = $chargeRequest->send();

        self::assertNotEmpty($chargeResponse);
        self::assertArrayNotHasKey('url', $chargeResponse);
        self::assertArrayNotHasKey('spTransID', $chargeResponse);
        self::assertArrayHasKey('errorCode', $chargeResponse);
        self::assertArrayHasKey('errorMessage', $chargeResponse);
        self::assertNotEmpty($chargeResponse['errorCode']);
        self::assertNotEmpty($chargeResponse['errorMessage']);
    }

    /**
     * @test
     * @throws Exception
     */
    final public function it_can_not_fetch_url_with_amount_less_than_2(): void
    {
        $orderID = 'test-app-' . random_int(111111, 999999);
        $chargeRequest = ChargeRequest::getInstance($this->chargeUrl, $this->accessToken, $this->clientID, $orderID, $this->package, 2 - 5, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);
        $chargeResponse = $chargeRequest->send();

        self::assertArrayNotHasKey('url', $chargeResponse);
        self::assertArrayNotHasKey('spTransID', $chargeResponse);
        self::assertArrayHasKey('errorCode', $chargeResponse);
        self::assertArrayHasKey('errorMessage', $chargeResponse);
        self::assertNotEmpty($chargeResponse['errorCode']);
        self::assertNotEmpty($chargeResponse['errorMessage']);
    }

    /**
     * @test
     * @throws Exception
     */
    final public function it_fails_to_fetch_url_with_amount_greater_than_99999(): void
    {
        $orderID = 'test-app-' . random_int(111111, 999999);
        $chargeRequest = ChargeRequest::getInstance($this->chargeUrl, $this->accessToken, $this->clientID, $orderID, $this->package, 99999 + 1, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);
        $chargeResponse = $chargeRequest->send();

        self::assertArrayNotHasKey('url', $chargeResponse);
        self::assertArrayNotHasKey('spTransID', $chargeResponse);
        self::assertArrayHasKey('errorCode', $chargeResponse);
        self::assertArrayHasKey('errorMessage', $chargeResponse);
        self::assertNotEmpty($chargeResponse['errorCode']);
        self::assertNotEmpty($chargeResponse['errorMessage']);
    }

    /**
     * @test
     * @throws Exception
     */
    final public function it_can_not_fetch_url_with_amount_greater_than_one_lac(): void
    {
        $orderID = 'test-app-' . random_int(111111, 999999);
        $amount = 100000;
        $chargeRequest = ChargeRequest::getInstance($this->chargeUrl, $this->accessToken, $this->clientID, $orderID, $this->package, $amount, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);
        $chargeResponse = $chargeRequest->send();

        self::assertArrayNotHasKey('url', $chargeResponse);
        self::assertArrayNotHasKey('spTransID', $chargeResponse);
        self::assertArrayHasKey('errorCode', $chargeResponse);
        self::assertArrayHasKey('errorMessage', $chargeResponse);
        self::assertNotEmpty($chargeResponse['errorCode']);
        self::assertNotEmpty($chargeResponse['errorMessage']);
    }

    /**
     * @test
     * @throws Exception
     */
    final public function it_can_not_fetch_url_with_empty_package(): void
    {
        $orderID = 'test-app-' . random_int(111111, 999999);
        $amount = random_int(10, 100);
        $chargeRequest = ChargeRequest::getInstance($this->chargeUrl, $this->accessToken, $this->clientID, $orderID, "", $amount, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);
        $chargeResponse = $chargeRequest->send();

        self::assertNotEmpty($chargeResponse);
        self::assertArrayNotHasKey('url', $chargeResponse);
        self::assertArrayNotHasKey('spTransID', $chargeResponse);
        self::assertArrayHasKey('errorCode', $chargeResponse);
        self::assertArrayHasKey('errorMessage', $chargeResponse);
        self::assertNotEmpty($chargeResponse['errorCode']);
        self::assertNotEmpty($chargeResponse['errorMessage']);
    }

    /**
     * @test
     * @throws Exception
     */
    final public function it_can_not_fetch_url_with_wrong_package(): void
    {
        $orderID = 'test-app-' . random_int(111111, 999999);
        $amount = random_int(10, 100);
        $chargeRequest = ChargeRequest::getInstance($this->chargeUrl, $this->accessToken, $this->clientID, $orderID, "wrong_package", $amount, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);
        $chargeResponse = $chargeRequest->send();

        self::assertNotEmpty($chargeResponse);
        self::assertArrayNotHasKey('url', $chargeResponse);
        self::assertArrayNotHasKey('spTransID', $chargeResponse);
        self::assertArrayHasKey('errorCode', $chargeResponse);
        self::assertArrayHasKey('errorMessage', $chargeResponse);
        self::assertNotEmpty($chargeResponse['errorCode']);
        self::assertNotEmpty($chargeResponse['errorMessage']);
    }

    /**
     * @test
     * @throws Exception
     */
    final public function it_can_not_fetch_url_with_empty_callbackUrl(): void
    {
        $orderID = 'test-app-' . random_int(111111, 999999);
        $amount = random_int(10, 100);
        $this->callBackURL = "";
        $chargeRequest = ChargeRequest::getInstance($this->chargeUrl, $this->accessToken, $this->clientID, $orderID, $this->package, $amount, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);
        $chargeResponse = $chargeRequest->send();

        self::assertNotEmpty($chargeResponse);
        self::assertArrayNotHasKey('url', $chargeResponse);
        self::assertArrayNotHasKey('spTransID', $chargeResponse);
        self::assertArrayHasKey('errorCode', $chargeResponse);
        self::assertArrayHasKey('errorMessage', $chargeResponse);
        self::assertNotEmpty($chargeResponse['errorCode']);
        self::assertNotEmpty($chargeResponse['errorMessage']);
    }

    /**
     * @test
     * @throws Exception
     */

    final public function it_can_not_fetch_url_with_invalid_callbackUrl(): void
    {
        $orderID = 'test-app-' . random_int(111111, 999999);
        $amount = random_int(10, 100);
        $this->callBackURL = "randomsite";
        $chargeRequest = ChargeRequest::getInstance($this->chargeUrl, $this->accessToken, $this->clientID, $orderID, $this->package, $amount, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);
        $chargeResponse = $chargeRequest->send();

        self::assertNotEmpty($chargeResponse);
        self::assertArrayNotHasKey('url', $chargeResponse);
        self::assertArrayNotHasKey('spTransID', $chargeResponse);
        self::assertArrayHasKey('errorCode', $chargeResponse);
        self::assertArrayHasKey('errorMessage', $chargeResponse);
        self::assertNotEmpty($chargeResponse['errorCode']);
        self::assertNotEmpty($chargeResponse['errorMessage']);
    }

    /**
     * @test
     * @throws Exception
     */

    final public function it_can_not_fetch_url_with_invalid_mobile_number(): void
    {
        $orderID = 'test-app-' . random_int(111111, 999999);
        $amount = random_int(10, 100);
        $this->mobile = '1234333333';
        $chargeRequest = ChargeRequest::getInstance($this->chargeUrl, $this->accessToken, $this->clientID, $orderID, $this->package, $amount, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);
        $chargeResponse = $chargeRequest->send();

        self::assertNotEmpty($chargeResponse);
        self::assertArrayNotHasKey('url', $chargeResponse);
        self::assertArrayNotHasKey('spTransID', $chargeResponse);
        self::assertArrayHasKey('errorCode', $chargeResponse);
        self::assertArrayHasKey('errorMessage', $chargeResponse);
        self::assertNotEmpty($chargeResponse['errorCode']);
        self::assertNotEmpty($chargeResponse['errorMessage']);
    }

    /**
     * @test
     * @throws Exception
     */

    final public function it_can_not_fetch_url_with_invalid_email(): void
    {
        $orderID = 'test-app-' . random_int(111111, 999999);
        $amount = random_int(10, 100);
        $this->email = 'lsadjjoe';
        $chargeRequest = ChargeRequest::getInstance($this->chargeUrl, $this->accessToken, $this->clientID, $orderID, $this->package, $amount, $this->callBackURL, $this->details, $this->mobile, $this->email, $this->reference);
        $chargeResponse = $chargeRequest->send();

        self::assertNotEmpty($chargeResponse);
        self::assertArrayNotHasKey('url', $chargeResponse);
        self::assertArrayNotHasKey('spTransID', $chargeResponse);
        self::assertArrayHasKey('errorCode', $chargeResponse);
        self::assertArrayHasKey('errorMessage', $chargeResponse);
        self::assertNotEmpty($chargeResponse['errorCode']);
        self::assertNotEmpty($chargeResponse['errorMessage']);
    }
}
