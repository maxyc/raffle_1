<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserEntities */

$this->title = 'Create User Entities';
$this->params['breadcrumbs'][] = ['label' => 'User Entities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-entities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
