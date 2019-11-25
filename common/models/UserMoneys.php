<?php

namespace common\models;

use common\models\query\UserMoneysQuery;
use Yii;

/**
 * This is the model class for table "{{%user_moneys}}".
 *
 * @property int $user_id
 * @property int $money
 * @property int $status
 *
 * @property User $user
 */
class UserMoneys extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_moneys}}';
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
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserMoneysQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserMoneysQuery(get_called_class());
    }
}
