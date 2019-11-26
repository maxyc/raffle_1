<?php


namespace common\models\contract;


use common\models\User;

interface RaffleInterface
{
    public static function isAvailable(): bool;

    public static function process(User $user): array;
}