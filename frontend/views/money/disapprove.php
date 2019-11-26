<?php

use yii\helpers\Html;

?>
<p class="lead">Вы успешно отказались от монет</p>
<p class="center-block">
    <?= Html::a('Хотите сыграть еще?', ['/'], ['class' => 'btn btn-primary']) ?>
    <br/>
    <?= Html::a('Личный кабинет', ['/cabinet'], ['class' => 'btn btn-link']) ?>
</p>
