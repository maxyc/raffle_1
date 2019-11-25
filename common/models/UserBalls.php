<?php

namespace common\models;

use common\models\query\UserBallsQuery;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%user_balls}}".
 *
 * @property int $user_id
 * @property int $value
 *
 * @property User $user
 */
class UserBalls extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_balls}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'value'], 'required'],
            [['user_id', 'value'], 'default', 'value' => null],
            [['user_id', 'value'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('common.user', 'User ID'),
            'value' => Yii::t('common.user', 'Value'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserBallsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserBallsQuery(get_called_class());
    }
}
