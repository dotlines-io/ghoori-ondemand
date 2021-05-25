<?php

namespace Dotlines\GhooriOnDemand\Tests;

use Dotlines\GhooriOnDemand\Models\Webhook;
use PHPUnit\Framework\TestCase;

class WebhookTest extends TestCase
{
    public string $spTransID;
    public string $package;
    public string $mobile;
    public string $amount;
    public string $bKashMsisdn;
    public string $status;
    public string $paymentDate;
    public string $processingStatus;
    public string $bKashTransID;
    public string $actionTaken;

    final public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->spTransID = "sadas";
        $this->package = "sdada";
        $this->mobile = "3333333";
        $this->amount = "33";
        $this->bKashMsisdn = "";
        $this->status = "";
        $this->paymentDate = "12-03-21";
        $this->processingStatus = "";
        $this->bKashTransID = "";
        $this->actionTaken = "";
    }

    /**
     * @test
     */

    final public function it_can_construct_a_webhook_object(): void
    {
        $webhookObj = new Webhook($this->spTransID, $this->package, $this->mobile, $this->amount, $this->bKashMsisdn, $this->status, $this->paymentDate, $this->processingStatus, $this->bKashTransID, $this->actionTaken);
        self::assertEquals("Dotlines\GhooriOnDemand\Models\Webhook", get_class($webhookObj));
    }
}
