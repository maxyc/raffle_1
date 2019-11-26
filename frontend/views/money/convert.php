<?php

use yii\helpers\Html;

?>

<p class="lead">
    Вы успешно конвертировали монеты в баллы лояльности.
</p>
<p class="center-block">
    Вы получили <strong><?= $balls ?></strong> баллов!<br/>
    Перейти в <?= Html::a('личный кабинет', ['/cabinet']); ?>
</p>