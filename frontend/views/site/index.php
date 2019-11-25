<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Розыгрыш!</h1>

        <p class="lead">Есть шанс выйграть любой предмет, деньги или баллы лояльности</p>

        <?php if(Yii::$app->user->isGuest):?>
            <p>Просто зарегистрируйтесь или авторизуйтесь для розыгрыша</p>
        <?php else:?>
            <p>Здравствуй, <strong><?=$userName?></strong>, тебе осталось лишь нажать на кнопку</p>
            <p class="center-block"><?=Html::a('Розыгрыш', ['raffle'], ['class'=>'btn btn-primary']);?></p>
        <?php endif;?>
    </div>

</div>
