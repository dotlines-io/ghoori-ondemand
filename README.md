# Ghoori OnDemand Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dotlines-io/ghoori-ondemand.svg?style=flat-square)](https://packagist.org/packages/dotlines-io/ghoori-ondemand)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/dotlines-io/ghoori-ondemand/run-tests?label=tests)](https://github.com/dotlines-io/ghoori-ondemand/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/dotlines-io/ghoori-ondemand/Check%20&%20fix%20styling?label=code%20style)](https://github.com/dotlines-io/ghoori-ondemand/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/dotlines-io/ghoori-ondemand.svg?style=flat-square)](https://packagist.org/packages/dotlines-io/ghoori-ondemand)

---

This composer package can be used for OnDemand payment integration with [Ghoori](http://ghoori.com.bd) Platform.
For the credentials, please contact with support@ghoori.com.bd or call 8809612332215

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
$orderID = ''; 
$package = ''; 
$amount = ''; 
$callBackURL = ''; 
$details = ''; 
$mobile = ''; 
$email = ''; 
$reference = '';
$chargeRequest = Dotlines\GhooriOnDemand\ChargeRequest::getInstance($chargeUrl, $accessToken, $clientID, $orderID, $package, $amount, $callBackURL, $details, $mobile, $email, $reference);
echo json_encode($chargeRequest->send()) . '<br/>';

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
 * ******************************************************
 * ******************* Refresh Token *******************
 * ******************************************************
 */
$refreshTokenRequest = Dotlines\GhooriOnDemand\RefreshTokenRequest::getInstance($tokenUrl, $accessToken, $clientID, $clientSecret, $refreshToken);
$tokenResponse = $refreshTokenRequest->send();
echo json_encode($tokenResponse) . '<br/>';
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [TareqMahbub](https://github.com/TareqMahbub)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
