<?php

namespace common\models;

use common\models\query\UserEntitiesQuery;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%user_entities}}".
 *
 * @property int $user_id
 * @property int $entity_id
 *
 * @property Entity $entity
 * @property User $user
 */
class UserEntities extends ActiveRecord
{
    const STATUS_WAIT = 0;
    const STATUS_APPROVE = 5;
    const STATUS_DISAPPROVE = 10;

    const STATUS_DELIVERY_WAIT = 0;
    const STATUS_DELIVERY_PROCESS = 5;
    const STATUS_DELIVERY_ARRIVED = 10;
    const STATUS_DELIVERY_DELIVERED = 20;

    public static function getStatusesText()
    {
        return [
            static::STATUS_WAIT => 'Ожидание решения',
            static::STATUS_APPROVE => 'Принял',
            static::STATUS_DISAPPROVE => 'Отказался'
        ];
    }

    public function getStatusText(){
        return static::getStatusesText()[$this->status];
    }

    public static function getDeliveryStatusesText()
    {
        return [
            static::STATUS_DELIVERY_WAIT => 'Ожидание отправки',
            static::STATUS_DELIVERY_PROCESS => 'Подготовка к отправке',
            static::STATUS_DELIVERY_ARRIVED => 'Отправлено',
            static::STATUS_DELIVERY_DELIVERED => 'Доставлено',
        ];
    }

    public function isWaitDelivery()
    {
        return $this->status == static::STATUS_APPROVE
            && $this->status_delivery == static::STATUS_DELIVERY_WAIT;
    }

    public function isProcessed()
    {
        return $this->status == static::STATUS_APPROVE
            && $this->status_delivery == static::STATUS_DELIVERY_PROCESS;
    }

    public function isArrived()
    {
        return $this->status == static::STATUS_APPROVE
            && $this->status_delivery == static::STATUS_DELIVERY_ARRIVED;
    }

    public function isDelivered()
    {
        return $this->status == static::STATUS_APPROVE
            && $this->status_delivery == static::STATUS_DELIVERY_DELIVERED;
    }

    public function getStatusDeliveryText(){
        return static::getDeliveryStatusesText()[$this->status_delivery];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_entities}}';
    }

    /**
     * {@inheritdoc}
     * @return UserEntitiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserEntitiesQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'entity_id'], 'required'],
            [['user_id', 'entity_id'], 'integer'],

            ['user_id', 'exist', 'targetClass' => User::class, 'targetAttribute' => 'id'],
            ['entity_id', 'exist', 'targetClass' => Entity::class, 'targetAttribute' => 'id'],

            ['status', 'default', 'value' => self::STATUS_WAIT],
            ['status', 'in', 'range' => [self::STATUS_WAIT, self::STATUS_APPROVE, self::STATUS_DISAPPROVE]],

            ['status_delivery', 'default', 'value' => self::STATUS_DELIVERY_WAIT],
            [
                'status_delivery',
                'in',
                'range' => [
                    self::STATUS_DELIVERY_WAIT,
                    self::STATUS_DELIVERY_PROCESS,
                    self::STATUS_DELIVERY_ARRIVED,
                    self::STATUS_DELIVERY_ARRIVED
                ]
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'entity_id' => 'Entity ID',
        ];
    }

    public function isWait()
    {
        return $this->status == static::STATUS_WAIT;
    }

    /**
     * @return ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(Entity::class, ['id' => 'entity_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
