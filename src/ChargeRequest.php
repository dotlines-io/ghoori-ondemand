<?php


namespace Dotlines\GhooriOnDemand;

use Dotlines\Core\Request;

class ChargeRequest extends Request
{
    private $clientID;
    private $orderID;
    private $package;
    private $amount;
    private $callBackURL;
    private $details;
    private $mobile;
    private $email;
    private $reference;

    public static function getInstance(string $url, string $accessToken, int $clientID, string $orderID, string $package, float $amount, string $callBackURL, string $details = '', string $mobile = '', string $email = '', string $reference = ''): ChargeRequest
    {
        return new ChargeRequest($url, $accessToken, $clientID, $orderID, $package, $amount, $callBackURL, $details, $mobile, $email, $reference);
    }

    /**
     * ChargeRequest constructor.
     *
     * @param string $url
     * @param string $accessToken
     * @param int $clientID
     * @param string $orderID
     * @param string $package
     * @param float $amount
     * @param string $callBackURL
     * @param string $details
     * @param string $mobile
     * @param string $email
     * @param string $reference
     */
    private function __construct(string $url, string $accessToken, int $clientID, string $orderID, string $package, float $amount, string $callBackURL, string $details = '', string $mobile = '', string $email = '', string $reference = '')
    {
        $this->requestMethod = 'POST';
        $this->url = $url;
        $this->accessToken = $accessToken;

        $this->clientID = (string)$clientID;
        $this->orderID = $orderID;
        $this->package = $package;
        $this->amount = $amount;
        $this->callBackURL = $callBackURL;
        $this->details = $details;
        $this->mobile = $mobile;
        $this->email = $email;
        $this->reference = $reference;
    }

    final public function params(): array
    {
        $params = [
            'clientID' => $this->clientID,
            'orderID' => $this->orderID,
            'package' => $this->package,
            'amount' => $this->amount,
            'callBackURL' => $this->callBackURL
        ];

        if (!empty($this->details)) {
            $params['details'] = $this->details;
        }

        if (!empty($this->mobile)) {
            $params['mobile'] = $this->mobile;
        }

        if (!empty($this->email)) {
            $params['email'] = $this->email;
        }

        if (!empty($this->reference)) {
            $params['reference'] = $this->reference;
        }

        return $params;
    }
}
