<?php

namespace common\models\query;

use common\models\UserBalls;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[UserBalls]].
 *
 * @see UserBalls
 */
class UserBallsQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserBalls[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserBalls|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
