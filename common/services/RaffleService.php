<?php

namespace common\services;

use common\models\BallsRaffle;
use common\models\GiftRaffle;
use common\models\MoneyRaffle;
use common\models\User;
use yii\base\ErrorException;

class RaffleService
{
    const TYPE_MONEY = 'money';
    const TYPE_BALLS = 'balls';
    const TYPE_GIFT = 'gift';

    private $user;

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @throws ErrorException
     * @throws \common\exceptions\EntityNotFoundException
     */
    public function process()
    {
        $types = [
            static::TYPE_BALLS,
        ];

        if(GiftRaffle::isAvailable())
        {
            $types[]=static::TYPE_GIFT;
        }

        if(MoneyRaffle::isAvailable())
        {
            $types[]=static::TYPE_MONEY;
        }

        $raffleType = $types[rand(0, 2)];

        switch ($raffleType) {
            default:
                throw new ErrorException('Unknown raffle type');
                break;
            case static::TYPE_GIFT:
                $result = GiftRaffle::process($this->user);
                break;
            case static::TYPE_MONEY:
                $result = MoneyRaffle::process($this->user);
                break;
            case static::TYPE_BALLS:
                $result = BallsRaffle::process($this->user);
                break;
        }

        $result['type'] = $raffleType;
        return $result;
    }
}