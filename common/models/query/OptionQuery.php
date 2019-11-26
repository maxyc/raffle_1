<?php

namespace common\models\query;

use common\models\Option;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Option]].
 *
 * @see Option
 */
class OptionQuery extends ActiveQuery
{
    public function money()
    {
        return $this->andWhere(['key' => 'money']);
    }

    public function percent()
    {
        return $this->andWhere(['key' => 'percent']);
    }

    public function coefficient()
    {
        return $this->andWhere(['key' => 'coefficient']);
    }

    /**
     * {@inheritdoc}
     * @return Option[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Option|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
