<?php

namespace common\models\search;

use common\models\UserEntity as UserEntitiesModel;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserEntities represents the model behind the search form of `common\models\UserEntities`.
 */
class UserEntity extends UserEntitiesModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'entity_id', 'status', 'status_delivery', 'id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UserEntitiesModel::find();
        $query->approved();
        $query->notDelivered();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
                'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(
            [
                'user_id' => $this->user_id,
                'entity_id' => $this->entity_id,
                'status' => $this->status,
                'status_delivery' => $this->status_delivery,
                'id' => $this->id,
            ]
        );

        return $dataProvider;
    }
}
