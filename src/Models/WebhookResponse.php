<?php

/** @noinspection UnknownInspectionInspection */
/** @noinspection PhpUnused */

namespace Dotlines\GhooriOnDemand\Models;

use JsonException;

/**
 * After Ghoori pushes a webhook to your Webhook Receiving endpoint
 * And after you've done necessary processing for the webhook
 * Please prepare an object of this class
 * And send it as a valid response
 *
 * Class WebhookResponse
 * @package Dotlines\GhooriOnDemand\Models
 */
class WebhookResponse
{
    public string $message;

    public function __construct(string $message = 'ACKNOWLEDGED')
    {
        $this->message = $message;
    }

    /**
     * @throws JsonException
     * @noinspection PhpUndefinedConstantInspection
     */
    public function __toString(): string
    {
        return json_encode(['actionTaken' => $this->message], JSON_THROW_ON_ERROR);
    }
}
