<?php

namespace common\services;

use common\integrations\contract\PostIntegrationInterface;
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
            return false;
        }

        $model->setDisapprovedStatus();
        $model->entity->increment();

        return true;
    }


    /**
     * @param UserEntity $model
     * @return bool
     */
    public function approve(UserEntity $model)
    {
        if (!$model->isWait()) {
            return false;
        }

        $model->setApproveedStatus();
        return true;
    }

    /**
     * @param UserEntity $model
     * @return bool
     */
    public function process(UserEntity $model)
    {
        $model->setProcessedStatus();
        return true;
    }

    /**
     * @param UserEntity $model
     * @param PostIntegrationInterface $post
     * @return bool
     */
    public function send(UserEntity $model, PostIntegrationInterface $post)
    {
        if ($post->send()) {
            $model->setArrivedStatus();
            return true;
        }

        return false;
    }

    /**
     * @param UserEntity $model
     * @param PostIntegrationInterface $post
     * @return bool
     */
    public function check(UserEntity $model, PostIntegrationInterface $post)
    {
        if ($post->check()) {
            $model->setDeliveredStatus();
            return true;
        }

        return false;
    }
}