<?php

/** @noinspection UnknownInspectionInspection */
/** @noinspection PhpUnused */

namespace Dotlines\GhooriOnDemand\Interfaces;

use Dotlines\GhooriOnDemand\Models\Webhook;
use Dotlines\GhooriOnDemand\Models\WebhookResponse;

/**
 * After Ghoori pushes a notification to your Webhook Receiving endpoint
 * Please prepare a webhook object from Webhook class
 * and pass it to your WebhookProcessor (extends this interface)
 *
 * Interface IWebhookProcessor
 * @package Dotlines\GhooriOnDemand\Interfaces
 */
interface IWebhookProcessor
{
    public function process(Webhook $notification, array $others = []): WebhookResponse;
}
