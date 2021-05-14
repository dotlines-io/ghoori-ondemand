<?php


namespace Dotlines\GhooriOnDemand;

use Dotlines\GhooriOnDemand\Helpers\RequestHelper;
use Dotlines\GhooriOnDemand\Interfaces\IRequest;
use JsonException;

abstract class Request implements IRequest
{
    protected $url;
    protected $accessToken = '';

    abstract public function params(): array;

    final public function headers(): array
    {
        return RequestHelper::make_headers($this->accessToken);
    }

    /**
     * @return array
     * @throws JsonException
     */
    final public function send(): array
    {
        return RequestHelper::send_request($this->url, $this->headers(), $this->params());
    }
}
