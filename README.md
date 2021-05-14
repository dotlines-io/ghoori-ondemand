# Ghoori OnDemand Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dotlines-io/ghoori-ondemand.svg?style=flat-square)](https://packagist.org/packages/dotlines-io/ghoori-ondemand)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/dotlines-io/ghoori-ondemand/run-tests?label=tests)](https://github.com/dotlines-io/ghoori-ondemand/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/dotlines-io/ghoori-ondemand/Check%20&%20fix%20styling?label=code%20style)](https://github.com/dotlines-io/ghoori-ondemand/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/dotlines-io/ghoori-ondemand.svg?style=flat-square)](https://packagist.org/packages/dotlines-io/ghoori-ondemand)

---

This package can be used for OnDemand payment integration with [Ghoori](http://ghoori.com.bd) Platform.
For the credentials please contact with support@ghoori.com.bd or call 8809612332215


## Installation

You can install the package via composer:

```bash
composer require dotlines-io/ghoori-ondemand
```

## Usage

```php
/**
 * ******************************************************
 * ******************* Token Fetching *******************
 * *********** Contact Ghoori For Credentials ***********
 * ******************************************************
 */
$tokenUrl = 'https://<SERVER_URL>/oauth/token';
$username = '';
$password = '';
$clientID = '';
$clientSecret = '';

$accessTokenRequest = Dotlines\GhooriOnDemand\AccessTokenRequest::getInstance($tokenUrl, $username, $password, $clientID, $clientSecret);
$tokenResponse = $accessTokenRequest->send();
echo json_encode($tokenResponse) . '<br/>';

/**
 * Access Token Request Response looks like below:
 * {
 *  "token_type": "Bearer",
 *  "expires_in": 3600,
 *  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdW.....",
 *  "refresh_token": "def50200284b2371cad76b4d2a4e24746c44fd6a322....."
 * }
 */

/**
 * Access Token can be cached and reused for 1 hour
 * Before the end of accessToken lifetime every hour
 * you can use the refresh token to fetch new accessToken & refreshToken
 */
$accessToken = $tokenResponse['access_token'];
$refreshToken = $tokenResponse['refresh_token'];

/**
 * ******************************************************
 * ******************* Charge Request *******************
 * ******************************************************
 */
$chargeUrl = 'https://<SERVER_URL>/api/v2.0/charge';
$orderID = ''; //must be unique for each request
$package = ''; //must be pre-registered with Ghoori
$amount = ''; //must be greater than or equal to BDT 2
$callBackURL = ''; //user will be redirected back this url
$details = ''; //optional
$mobile = ''; //optional
$email = ''; //optional
$reference = ''; //optional
$chargeRequest = Dotlines\GhooriOnDemand\ChargeRequest::getInstance($chargeUrl, $accessToken, $clientID, $orderID, $package, $amount, $callBackURL, $details, $mobile, $email, $reference);
echo json_encode($chargeRequest->send()) . '<br/>';

/**
 * Success Charge Request Response looks like below.
 * You must redirect the user to the "url" for payment.
 * {
 *  "url": "https://sb-payments.ghoori.com.bd/v2.0/pay/BD/bKash?spTransID=5QUWSGRBP41EE46",
 *  "spTransID": "5QUWSGRBP41EE46",
 *  "errorCode": "00",
 *  "errorMessage": "Operation Success"
 * }
 * Fail response only contains errorCode & errorMessage
 */

/**
 * ******************************************************
 * ******************* Status Request *******************
 * ******************************************************
 */
$statusUrl = 'https://<SERVER_URL>/api/v2.0/status';
$spTransID = '';
$statusRequest = Dotlines\GhooriOnDemand\StatusRequest::getInstance($statusUrl, $accessToken, $clientID, $spTransID);
echo json_encode($statusRequest->send()) . '<br/>';

/**
 * Status Request Response looks like below:
 * {
 *  "processingStatus": "CHARGED",
 *  "status": "DONE",
 *  "amount": "10.00",
 *  "errorCode": "00",
 *  "errorMessage": "Operation Successful",
 *  "bKashTransID": "6JS7L72YMV",
 *  "reference": "reference not provided"
 * }
 * Fail response only contains errorCode & errorMessage
 */

/**
 * ******************************************************
 * ******************* Refresh Token *******************
 * ******************************************************
 */
$refreshTokenRequest = Dotlines\GhooriOnDemand\RefreshTokenRequest::getInstance($tokenUrl, $accessToken, $clientID, $clientSecret, $refreshToken);
$tokenResponse = $refreshTokenRequest->send();
echo json_encode($tokenResponse) . '<br/>';

/**
 * Refresh Token Request Response looks like below:
 * {
 *  "token_type": "Bearer",
 *  "expires_in": 3600,
 *  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdW.....",
 *  "refresh_token": "def50200284b2371cad76b4d2a4e24746c44fd6a322....."
 * }
 */
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [TareqMahbub](https://github.com/TareqMahbub)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
