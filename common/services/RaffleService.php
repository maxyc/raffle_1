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
        $raffleType = static::TYPE_GIFT;//$this->getTypes()[rand(0, 2)];

        switch ($raffleType) {
            default:
                throw new ErrorException('Unknown raffle type');
                break;
            case static::TYPE_GIFT:
                if(GiftRaffle::isAvailable()) {
                    $result = GiftRaffle::process($this->user);
                }
                else
                {
                    $raffleType = static::TYPE_BALLS;
                    $result = BallsRaffle::process($this->user);
                }
                break;
            case static::TYPE_MONEY:
                if(MoneyRaffle::isAvailable()) {
                    $result = MoneyRaffle::process($this->user);
                }
                else
                {
                    $raffleType = static::TYPE_BALLS;
                    $result = BallsRaffle::process($this->user);
                }
                break;
            case static::TYPE_BALLS:
                $result = BallsRaffle::process($this->user);
                break;
        }

        $result['type'] = $raffleType;
        return $result;
    }

    protected function getTypes()
    {
        return [
            static::TYPE_MONEY,
            static::TYPE_BALLS,
            static::TYPE_GIFT,
        ];
    }


}