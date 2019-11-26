<?php

namespace common\models\query;

use common\models\UserMoney;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[UserMoneys]].
 *
 * @see UserMoney
 */
class UserMoneysQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function approved()
    {
        return $this->andWhere(['status' => UserMoney::STATUS_APPROVE]);
    }

    /**
     * {@inheritdoc}
     * @return UserMoney[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserMoney|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
