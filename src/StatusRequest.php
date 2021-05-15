<?php


namespace Dotlines\GhooriOnDemand;

use Dotlines\Ghoori\Request;

class StatusRequest extends Request
{
    private $clientID;
    private $spTransID;

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
        $this->url = $url;
        $this->accessToken = $accessToken;

        $this->clientID = $clientID;
        $this->spTransID = $spTransID;
    }

    final public function params(): array
    {
        return [
            'clientID' => (string)$this->clientID,
            'spTransID' => $this->spTransID
        ];
    }
}
