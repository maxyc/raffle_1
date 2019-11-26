<?php

use yii\helpers\Html;

?>

<p>Вы получили
    <strong>подарок</strong>
    <?= $result['userEntity']->entity->name ?>
    в кол-ве
    1 шт</p>

<p>Вы можете
    <?= Html::a('принять', ['/gift/approve', 'id' => $result['userEntity']->id], ['class' => 'btn btn-success']) ?>
    подарок или
    <?= Html::a('отказаться', ['/gift/disapprove', 'id' => $result['userEntity']->id], ['class' => 'btn btn-danger']) ?>
    от него</p>

<p>Вы можете решить позже в <?= Html::a('личном кабинете', ['/cabinet']); ?> или <?= Html::a(
        'сыграть еще раз',
        ['/']
    ); ?></p>