<?php
namespace common\models;

use common\models\Entity;
use common\models\User;
use common\models\UserEntities;
use yii\db\Expression;

class BallsRaffle implements RaffleInterface
{
    public static function process(User $user): bool
    {

        return true;
    }
}