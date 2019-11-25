<?php

use yii\helpers\Html;

?>

<p>Вы получили
    <strong>подарок</strong>
    <?=$result['userEntity']->entity->name?>
    в кол-ве
    1 шт</p>

<p>Вы можете
    <?= Html::a('принять', ['approve-gift', 'id'=>$result['userEntity']->id], ['class'=>'btn btn-success'])?>
    подарок или
    <?= Html::a('отказаться', ['disapprove-gift', 'id'=>$result['userEntity']->id], ['class'=>'btn btn-danger'])?>
    от него</p>