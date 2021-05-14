<?php


namespace Dotlines\GhooriOnDemand;

class AccessTokenRequest extends Request
{
    private $username;
    private $password;
    private $clientID;
    private $clientSecret;

    public static function getInstance(string $url, string $username, string $password, int $clientID, string $clientSecret): AccessTokenRequest
    {
        return new AccessTokenRequest($url, $username, $password, $clientID, $clientSecret);
    }

    private function __construct(string $url, string $username, string $password, int $clientID, string $clientSecret)
    {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
        $this->clientID = $clientID;
        $this->clientSecret = $clientSecret;
    }

    final public function params(): array
    {
        return [
            'grant_type' => 'password',
            'username' => $this->username,
            'password' => $this->password,
            'client_id' => $this->clientID,
            'client_secret' => $this->clientSecret,
            'scope' => '',
        ];
    }
}
