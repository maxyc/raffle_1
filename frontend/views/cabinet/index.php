<?php

?>
<p class="lead">Здравствуй, <strong><?= $user->username ?></strong></p>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <p class="lead">Подарки</p>

            <?= $this->render('_entities_list', ['list' => $userEntities]); ?>
        </div>
        <div class="col-md-4">
            <p class="lead">Монеты (Баланс: <?= $user->getMoneyBalance() ?>)</p>

            <?= $this->render('_money_list', ['list' => $userMoneys]); ?>

            <p class="text-danger">
                <small>* При конвертации монет в баллы вы получите <?= $convertPercent ?>% от суммы
                    конвертации</small>
            </p>
        </div>
        <div class="col-md-4">
            <p class="lead">Баллы лояльности (Баланс: <?= $user->balls ?>)</p>
        </div>
    </div>
</div>