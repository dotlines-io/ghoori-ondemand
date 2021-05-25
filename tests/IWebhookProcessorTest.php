<?php

namespace Dotlines\GhooriOnDemand\Tests;

use Dotlines\GhooriOnDemand\Interfaces\IWebhookProcessor;
use Dotlines\GhooriOnDemand\Models\Webhook;
use Dotlines\GhooriOnDemand\Models\WebhookResponse;
use PHPUnit\Framework\TestCase;

class IWebhookProcessorTest extends TestCase
{
    public string $spTransID="";
    public string $package="";
    public string $mobile="";
    public string $amount="";
    public string $bKashMsisdn="";
    public string $status="";
    public string $paymentDate="";
    public string $processingStatus="";
    public string $bKashTransID="";
    public string $actionTaken="";
    public string $message="";
    /**
     * @test
     */
    final public function it_succeeds_implementing_IWebhookProcessor(): void
    {
        $webhookObj = new Webhook($this->spTransID, $this->package, $this->mobile, $this->amount, $this->bKashMsisdn, $this->status, $this->paymentDate, $this->processingStatus, $this->bKashTransID, $this->actionTaken );
        $webhookResponseObj = new WebhookResponse($this->message);
        $stub = $this->createStub(IWebhookProcessor::class);
        $stub->method('process')
            ->willReturn($webhookResponseObj);
        self::assertSame($webhookResponseObj, $stub->process($webhookObj, ['value1','value2']));
        self::assertEquals("Dotlines\GhooriOnDemand\Models\WebhookResponse", get_class($stub->process($webhookObj, ['value1','value2'])));
    }
}