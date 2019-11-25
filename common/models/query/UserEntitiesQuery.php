<?php

namespace common\models\query;

use common\models\UserEntities;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[UserEntities]].
 *
 * @see UserEntities
 */
class UserEntitiesQuery extends ActiveQuery
{
    public function approved()
    {
        return $this->andWhere(['status' => UserEntities::STATUS_APPROVE]);
    }

    public function notDelivered()
    {
        return $this->andWhere(['!=', 'status_delivery', UserEntities::STATUS_DELIVERY_DELIVERED]);
    }

    /**
     * {@inheritdoc}
     * @return UserEntities[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserEntities|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
