<?php

namespace common\integrations\contract;


interface PostIntegrationInterface
{
    /**
     * send request to post
     * @return bool
     */
    public function send(): bool;

    /**
     * Check post request
     * @return bool
     */
    public function check(): bool;
}