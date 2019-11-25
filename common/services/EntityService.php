<?php
namespace common\services;

use common\models\Entity;
use common\models\User;
use common\models\UserEntities;
use yii\base\ErrorException;

class EntityService
{
    /**
     * @param $id
     * @return bool
     * @throws ErrorException
     */
    public function disapprove($id)
    {
        $userEntity = $this->getUserEntity($id);
        if(!$userEntity)
        {
            throw new ErrorException('User entity #'.$id.' not found');
        }

        if(!$userEntity->isWait())
        {
            return true;
        }

        $userEntity->updateAttributes(['status' => UserEntities::STATUS_DISAPPROVE]);

        $userEntity->entity->updateCounters(['in_stock'=>1]);

        return true;
    }

    /**
     * @param $id
     * @return bool
     * @throws ErrorException
     */
    public function approve($id)
    {
        $userEntity = $this->getUserEntity($id);

        if(!$userEntity->isWait())
        {
            return true;
        }

        $userEntity->updateAttributes(['status' => UserEntities::STATUS_APPROVE]);
        return true;
    }

    private function getUserEntity($id)
    {
        $userEntities = UserEntities::findOne($id);
        if(!$userEntities)
        {
            throw new ErrorException('User entity #'.$id.' not found');
        }

        return $userEntities;
    }
}