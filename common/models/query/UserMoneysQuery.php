<?php

namespace common\models\query;

use common\models\UserMoneys;

/**
 * This is the ActiveQuery class for [[UserMoneys]].
 *
 * @see UserMoneys
 */
class UserMoneysQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserMoneys[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserMoneys|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
