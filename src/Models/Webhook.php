<?php

/** @noinspection UnknownInspectionInspection */
/** @noinspection SpellCheckingInspection */
/** @noinspection PhpUnused */


namespace Dotlines\GhooriOnDemand\Models;

/**
 * You will provide a Webhook receiving API endpoint to Ghoori
 * After that Ghoori will start pushing Webhooks to this API endpoint
 *
 * How to use:
 * After Ghoori pushes a Webhook to your Webhook Receiving endpoint
 * Please prepare a webhook object from this class
 * and pass it to your WebhookProcessor
 *
 * Class Webhook
 * @package Dotlines\GhooriOnDemand\Models
 */
class Webhook
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

    public function __construct(string $spTransID, string $package, string $mobile, string $amount, string $bKashMsisdn, string $status, string $paymentDate, string $processingStatus, string $bKashTransID, string $actionTaken)
    {
        $this->spTransID = $spTransID;
        $this->package = $package;
        $this->mobile = $mobile;
        $this->amount = $amount;
        $this->bKashMsisdn = $bKashMsisdn;
        $this->status = $status;
        $this->paymentDate = $paymentDate;
        $this->processingStatus = $processingStatus;
        $this->bKashTransID = $bKashTransID;
        $this->actionTaken = $actionTaken;
    }
}
