<?php

namespace common\models\query;

use common\models\Entity;

/**
 * This is the ActiveQuery class for [[Entity]].
 *
 * @see Entity
 */
class EntityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function available()
    {
        return $this->andWhere(['>', 'in_stock', 0]);
    }

    /**
     * {@inheritdoc}
     * @return Entity[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Entity|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
