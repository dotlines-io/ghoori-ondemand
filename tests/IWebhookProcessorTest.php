<?php

namespace Dotlines\GhooriOnDemand\Tests;

use Dotlines\GhooriOnDemand\Models\WebhookResponse;
use PHPUnit\Framework\TestCase;

class IWebhookProcessorTest extends TestCase
{
    /**
     * @test
     */
    final public function it_can_process_a_webhook_notification(): void
    {
        $webhookResponseObj = new WebhookResponse("sadasfdas");
        $this->assertInstanceOf(WebhookResponse::class, $webhookResponseObj);
    }
}
