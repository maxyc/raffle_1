<?php

namespace common\services;

use common\models\UserEntity;

class EntityService
{
    /**
     * @param UserEntity $model
     * @return bool
     */
    public function disapprove(UserEntity $model)
    {
        if (!$model->isWait()) {
            return true;
        }

        $model->updateAttributes(['status' => UserEntity::STATUS_DISAPPROVE]);
        $model->entity->updateCounters(['in_stock' => 1]);

        return true;
    }


    /**
     * @param UserEntity $model
     * @return bool
     */
    public function approve(UserEntity $model)
    {
        if (!$model->isWait()) {
            return true;
        }

        $model->updateAttributes(['status' => UserEntity::STATUS_APPROVE]);
        return true;
    }

    public function process(UserEntity $model)
    {
        $model->updateAttributes(['status_delivery' => UserEntity::STATUS_DELIVERY_PROCESS]);
    }

    public function send(UserEntity $model)
    {
        $model->updateAttributes(['status_delivery' => UserEntity::STATUS_DELIVERY_ARRIVED]);
    }

    public function deliver(UserEntity $model)
    {
        $model->updateAttributes(['status_delivery' => UserEntity::STATUS_DELIVERY_DELIVERED]);
    }


}