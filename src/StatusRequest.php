<?php


namespace Dotlines\GhooriOnDemand;

use Dotlines\Core\Request;

class StatusRequest extends Request
{
    private int $clientID;
    private string $spTransID;

    public static function getInstance(string $url, string $accessToken, int $clientID, string $spTransID): StatusRequest
    {
        return new StatusRequest($url, $accessToken, $clientID, $spTransID);
    }

    /**
     * ChargeRequest constructor.
     *
     * @param string $url
     * @param string $accessToken
     * @param int $clientID
     * @param string $spTransID
     */
    private function __construct(string $url, string $accessToken, int $clientID, string $spTransID)
    {
        $this->requestMethod = 'POST';
        $this->url = $url;
        $this->accessToken = $accessToken;

        $this->clientID = $clientID;
        $this->spTransID = $spTransID;
    }

    final public function params(): array
    {
        return [
            'clientID' => (string)$this->clientID,
            'spTransID' => $this->spTransID,
        ];
    }
}
