<?php


namespace common\integrations\contract;


interface BankIntegrationInterface
{
    /**
     * send request to bank
     * @return bool
     */
    public function send(): bool;

    /**
     * Check bank request
     * @return bool
     */
    public function check(): bool;
}