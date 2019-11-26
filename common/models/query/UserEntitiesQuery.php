<?php

namespace common\models\query;

use common\models\UserEntity;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[UserEntities]].
 *
 * @see UserEntity
 */
class UserEntitiesQuery extends ActiveQuery
{
    public function approved()
    {
        return $this->andWhere(['status' => UserEntity::STATUS_APPROVE]);
    }

    public function notDelivered()
    {
        return $this->andWhere(['!=', 'status_delivery', UserEntity::STATUS_DELIVERY_DELIVERED]);
    }

    /**
     * {@inheritdoc}
     * @return UserEntity[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserEntity|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
