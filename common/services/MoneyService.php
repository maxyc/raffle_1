<?php

namespace common\services;

use common\integrations\contract\BankIntegrationInterface;
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

        $model->setDisapprovedStatus();

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

        $model->setApproveedStatus();
        return true;
    }

    /**
     * @param int $convertProcent
     * @param UserMoney $model
     * @param User $user
     * @return bool
     */
    public function convert($convertProcent, UserMoney $model, User $user)
    {
        if (!$model->isWait()) {
            return false;
        }

        $balls = ceil($model->money / 100) * $convertProcent;

        $user->addBalls($balls);
        $model->setConvertedStatus();

        return true;
    }

    /**
     * @param UserMoney $model
     * @param BankIntegrationInterface $bank
     */
    public function send(UserMoney $model, BankIntegrationInterface $bank)
    {
        $model->setProcessedStatus();

        if ($bank->send()) // не вдаюсь в подробности апи банка, это уже другая задача
        {
            $model->setArrivedStatus();
        }
    }

    /**
     * @param UserMoney $model
     * @param BankIntegrationInterface $bank
     */
    public function check(UserMoney $model, BankIntegrationInterface $bank)
    {
        if ($bank->check()) // не вдаюсь в подробности апи банка, это уже другая задача
        {
            $model->setDeliveredStatus();
        }
    }
}