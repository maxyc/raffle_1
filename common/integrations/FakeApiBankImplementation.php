<?php

namespace common\integrations;

use common\integrations\contract\BankIntegrationInterface;

class FakeApiBankImplementation implements BankIntegrationInterface
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