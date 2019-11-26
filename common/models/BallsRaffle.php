<?php
namespace common\models;

use common\models\contract\RaffleInterface;

class BallsRaffle implements RaffleInterface
{
    public static function process(User $user): array
    {
        $maxBalls = Option::find()->balls()->select(['value'])->scalar();
        $balls = rand(1, $maxBalls);

        $user->updateCounters(['balls' => $balls]);

        return [
            'value' => $balls
        ];
    }

    /**
     * @return bool
     */
    public static function isAvailable(): bool
    {
        return true;
    }
}