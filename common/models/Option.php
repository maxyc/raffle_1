<?php

namespace common\models;

use common\models\query\OptionQuery;
use Yii;

/**
 * This is the model class for table "{{%option}}".
 *
 * @property string $key
 * @property string $value
 */
class Option extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%option}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['key', 'value'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'key' => Yii::t('common.option', 'Key'),
            'value' => Yii::t('common.option', 'Value'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return OptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OptionQuery(get_called_class());
    }
}
