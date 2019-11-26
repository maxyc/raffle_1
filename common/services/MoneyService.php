<?php

namespace common\services;

use common\models\Option;
use common\models\User;
use common\models\UserMoney;
use Exception;
use Yii;

class MoneyService
{
    /**
     * @param UserMoney $model
     * @return bool
     */
    public function disapprove(UserMoney $model)
    {
        if (!$model->isWait()) {
            return true;
        }

        $model->updateAttributes(['status' => UserMoney::STATUS_DISAPPROVE]);

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $bank = Option::find()->money()->one();
            $bank->updateAttributes(['value' => $bank->value + $model->money]);
            $transaction->commit();
            return true;
        } catch (Exception $e) {
            $transaction->rollback();
            return false;
        }
    }


    /**
     * @param UserMoney $model
     * @return bool
     */
    public function approve(UserMoney $model)
    {
        if (!$model->isWait()) {
            return true;
        }

        $model->updateAttributes(['status' => UserMoney::STATUS_APPROVE]);

        return true;
    }

    /**
     * @param UserMoney $model
     * @param User $user
     * @return bool
     */
    public function convert($convertProcent, UserMoney $model, User $user)
    {
        if (!$model->isWait()) {
            return false;
        }

        $summ = ceil($model->money / 100) * $convertProcent;

        $user->updateCounters(['balls' => $summ]);
        $model->updateAttributes(['status' => UserMoney::STATUS_CONVERTED]);

        return true;
    }

//    public function process($id)
//    {
//        $userEntity = $this->getUserMoney($id);
//        $userEntity->updateAttributes(['status_delivery' => UserMoney::STATUS_DELIVERY_PROCESS]);
//    }
//
//    public function send($id)
//    {
//        $userEntity = $this->getUserMoney($id);
//        $userEntity->updateAttributes(['status_delivery' => UserMoney::STATUS_DELIVERY_ARRIVED]);
//    }
//
//    public function deliver($id)
//    {
//        $userEntity = $this->getUserMoney($id);
//        $userEntity->updateAttributes(['status_delivery' => UserMoney::STATUS_DELIVERY_DELIVERED]);
//    }
}