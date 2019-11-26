<?php

use yii\helpers\Html;

?>

<p class="lead">Вы получили
    <strong>баллы лояльности</strong>
    <?= $result['value'] ?>
</p>

<p>Вы можете перейти в <?= Html::a('личный кабинет', ['/cabinet']); ?> или <?= Html::a(
        'сыграть еще раз',
        ['/']
    ); ?>
</p>