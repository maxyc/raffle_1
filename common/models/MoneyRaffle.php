<?php
namespace common\models;

use common\models\contract\RaffleInterface;
use Exception;
use Yii;
use yii\base\ErrorException;

class MoneyRaffle implements RaffleInterface
{
    public static function process(User $user): array
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $bank = Option::find()->money()->select(['value'])->scalar();
            $percent = Option::find()->percent()->select(['value'])->scalar();

            $maxSumm = ceil($bank / 100) * $percent;
            $raffleSumm = rand(1, $maxSumm); // в задаче не указано, но врятли суммы в розыгрыше могут быть не целыми

            $userMoney = static::offerToUser($raffleSumm, $user);
            if (!$userMoney) {
                throw new ErrorException('Error offer money to user');
            } else {
                Option::find()->money()->one()->updateAttributes(['value' => $bank - $raffleSumm]);
            }

            $transaction->commit();

            return [
                'userMoney' => $userMoney
            ];
        } catch (Exception $e) {
            $transaction->rollback();
            return [];
        }
    }

    protected static function offerToUser($summ, User $user)
    {
        $userMoney = new UserMoney();
        $userMoney->user_id = $user->id;
        $userMoney->money = $summ;

        if ($userMoney->save()) {
            return $userMoney;
        }

        return false;
    }

    public static function isAvailable(): bool
    {
        return Option::find()->money()->select(['value'])->scalar() > 0;
    }
}