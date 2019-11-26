<?php
namespace common\models;

use common\models\contract\RaffleInterface;

class BallsRaffle implements RaffleInterface
{
    public static function process(User $user): bool
    {

        return true;
    }
}