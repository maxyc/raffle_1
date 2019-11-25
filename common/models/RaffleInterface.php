<?php


namespace common\models;


interface RaffleInterface
{
    public static function isAvailable(): bool;

    public static function process(User $user): array;
}