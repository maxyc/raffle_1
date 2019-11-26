<?php

use yii\helpers\Html;

?>

<p>Вы получили
    <strong>денежный приз</strong>
    <?= $result['userMoney']->money ?> монеты
</p>

<p>Вы можете
    <?= Html::a(
        'принять',
        ['/cabinet/approve-money', 'id' => $result['userMoney']->id],
        ['class' => 'btn btn-success']
    ) ?>
    подарок или
    <?= Html::a(
        'отказаться',
        ['/cabinet/disapprove-money', 'id' => $result['userMoney']->id],
        ['class' => 'btn btn-danger']
    ) ?>
    от него или
    <?= Html::a(
        'конвертировать в баллы лояльности',
        ['/cabinet/convert-money', 'id' => $result['userMoney']->id],
        ['class' => 'btn btn-warning']
    ) ?>
</p>