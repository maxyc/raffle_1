<?php

namespace common\models;

use common\models\query\EntityQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%entity}}".
 *
 * @property int $id
 * @property string $name
 * @property int $in_stock
 *
 * @property UserEntity[] $userEntities
 */
class Entity extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%entity}}';
    }

    /**
     * {@inheritdoc}
     * @return EntityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EntityQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['in_stock'], 'default', 'value' => null],
            [['in_stock'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common.entity', 'ID'),
            'name' => Yii::t('common.entity', 'Name'),
            'in_stock' => Yii::t('common.entity', 'In Stock'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUserEntities()
    {
        return $this->hasMany(UserEntity::class, ['entity_id' => 'id']);
    }

    /**
     * @return bool
     */
    public function increment()
    {
        return $this->updateCounters(['in_stock' => 1]);
    }

    /**
     * @return bool
     */
    public function decrement()
    {
        return $this->updateCounters(['in_stock' => -1]);
    }
}
