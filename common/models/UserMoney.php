<?php

namespace common\models;

use common\models\query\UserMoneyQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%user_moneys}}".
 *
 * @property int $user_id
 * @property int $money
 * @property int $status
 *
 * @property User $user
 */
class UserMoney extends ActiveRecord
{
    const STATUS_WAIT = 0;
    const STATUS_APPROVE = 5;
    const STATUS_DISAPPROVE = 10;
    const STATUS_CONVERTED = 15;

    const STATUS_DELIVERY_WAIT = 0;
    const STATUS_DELIVERY_PROCESS = 5;
    const STATUS_DELIVERY_ARRIVED = 10;
    const STATUS_DELIVERY_DELIVERED = 20;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_moneys}}';
    }

    /**
     * {@inheritdoc}
     * @return UserMoneyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserMoneyQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'money'], 'required'],
            [['user_id', 'money', 'status'], 'default', 'value' => null],
            [['user_id', 'money', 'status'], 'integer'],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['user_id' => 'id']
            ],

            ['status', 'default', 'value' => self::STATUS_WAIT],
            [
                'status',
                'in',
                'range' => [self::STATUS_WAIT, self::STATUS_APPROVE, self::STATUS_DISAPPROVE, static::STATUS_CONVERTED]
            ],

            ['status_delivery', 'default', 'value' => self::STATUS_DELIVERY_WAIT],
            [
                'status_delivery',
                'in',
                'range' => [
                    self::STATUS_DELIVERY_WAIT,
                    self::STATUS_DELIVERY_PROCESS,
                    self::STATUS_DELIVERY_ARRIVED,
                    self::STATUS_DELIVERY_DELIVERED
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
            'user_id' => Yii::t('common.user', 'User ID'),
            'money' => Yii::t('common.user', 'Money'),
            'status' => Yii::t('common.user', 'Status'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function isWait()
    {
        return $this->status == static::STATUS_WAIT;
    }


    public function getStatusText()
    {
        return static::getStatusesText()[$this->status];
    }

    public static function getStatusesText()
    {
        return [
            static::STATUS_WAIT => 'Ожидание решения',
            static::STATUS_APPROVE => 'Принял',
            static::STATUS_DISAPPROVE => 'Отказался',
            static::STATUS_CONVERTED => 'Конвертировал'
        ];
    }

    public function setProcessedStatus()
    {
        $this->updateAttributes(['status_delivery' => UserMoney::STATUS_DELIVERY_PROCESS]);
    }

    public function setArrivedStatus()
    {
        $this->updateAttributes(['status_delivery' => UserMoney::STATUS_DELIVERY_ARRIVED]);
    }

    public function setDeliveredStatus()
    {
        $this->updateAttributes(['status_delivery' => UserMoney::STATUS_DELIVERY_DELIVERED]);
    }

    public function setConvertedStatus()
    {
        $this->updateAttributes(['status_delivery' => UserMoney::STATUS_CONVERTED]);
    }

    public function setDisapprovedStatus()
    {
        $this->updateAttributes(['status_delivery' => UserMoney::STATUS_DISAPPROVE]);
    }

    public function setApproveedStatus()
    {
        $this->updateAttributes(['status_delivery' => UserMoney::STATUS_APPROVE]);
    }

    public function isWaitDelivery()
    {
        return $this->isApproved()
            && $this->status_delivery == static::STATUS_DELIVERY_WAIT;
    }

    public function isApproved()
    {
        return $this->status == static::STATUS_APPROVE;
    }

    public function isProcessed()
    {
        return $this->isApproved()
            && $this->status_delivery == static::STATUS_DELIVERY_PROCESS;
    }

    public function isArrived()
    {
        return $this->isApproved()
            && $this->status_delivery == static::STATUS_DELIVERY_ARRIVED;
    }

    public function isDelivered()
    {
        return $this->isApproved()
            && $this->status_delivery == static::STATUS_DELIVERY_DELIVERED;
    }

    public function getStatusDeliveryText()
    {
        return static::getDeliveryStatusesText()[$this->status_delivery];
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
}
