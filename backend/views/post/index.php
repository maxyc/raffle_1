<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserEntities */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Entities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-entities-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute'=>'user_id',
                'value'=>function($model){
                    return $model->user->username;
                }
            ],
            [
                'attribute'=>'entity_id',
                'value'=>function($model){
                    return $model->entity->name;
                }
            ],

            [
                'attribute'=>'status_delivery',
                'value'=>function($model){
                    return $model->statusDeliveryText;
                }
            ],
            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{process} {arrive} {deliver}',
                'buttons'=>[
                    'process'=>function($url, $model, $key){
                        return Html::a('Подготовить', ['process', 'id'=>$model->id], ['class'=>'btn btn-xs btn-info']);
                    },
                    'arrive'=>function($url, $model, $key){
                        return Html::a('Отправить', ['arrive', 'id'=>$model->id], ['class'=>'btn btn-xs btn-warning']);
                    },
                    'deliver'=>function($url, $model, $key){
                        return Html::a('Доставлено', ['deliver', 'id'=>$model->id], ['class'=>'btn btn-xs btn-success']);
                    },
                ],
                'visibleButtons'=>[
                    'process'=>function($model){return $model->isWaitDelivery();},
                    'arrive'=>function($model){return $model->isProcessed();},
                    'deliver'=>function($model){return $model->isArrived();},
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
