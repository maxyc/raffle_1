<?php

namespace common\models\query;

use common\models\UserMoney;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[UserMoneys]].
 *
 * @see UserMoney
 */
class UserMoneyQuery extends ActiveQuery
{

    public function waitSend()
    {
        return $this->approved()->andWhere(['status_delivery' => UserMoney::STATUS_WAIT]);
    }

    public function approved()
    {
        return $this->andWhere(['status' => UserMoney::STATUS_APPROVE]);
    }

    public function arrived()
    {
        return $this->andWhere(['status_delivery' => UserMoney::STATUS_DELIVERY_ARRIVED]);
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
