<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Raffle';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Розыгрыш успешно проведен</p>
    <?=$this->render('raffle_type/'.$result['type'], ['result'=>$result])?>
</div>
