<?php

namespace common\integrations;

use common\integrations\contract\BankIntegrationInterface;
use common\integrations\contract\PostIntegrationInterface;

class FakePostBankImplementation implements BankIntegrationInterface, PostIntegrationInterface
{
    public function send(): bool
    {
        return true;
    }

    public function check(): bool
    {
        return true;
    }
}