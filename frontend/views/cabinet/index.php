<?php

use common\models\UserEntities;
use yii\helpers\Html;

$statusesMap = [
    UserEntities::STATUS_WAIT => 'info',
    UserEntities::STATUS_APPROVE => 'success',
    UserEntities::STATUS_DISAPPROVE => 'danger',
];

$statusesDeliveryMap = [
    UserEntities::STATUS_DELIVERY_WAIT => 'default',
    UserEntities::STATUS_DELIVERY_PROCESS => 'primary',
    UserEntities::STATUS_DELIVERY_ARRIVED => 'success',
    UserEntities::STATUS_DELIVERY_DELIVERED => 'success',
];

?>
<p class="lead">Здравствуй, <strong><?= $user->username ?></strong></p>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <p class="lead">Подарки</p>

            <ul class="list-group">
                <?php foreach ($userEntities as $userEntity): ?>
                    <li class="list-group-item">
                        <?= $userEntity->entity->name ?>
                        <span class="label label-<?= $statusesMap[$userEntity->status] ?>">
                        <?= $userEntity->statusText ?>
                    </span>

                        <?php if ($userEntity->status == UserEntities::STATUS_APPROVE): ?>
                            <span class="label label-<?= $statusesDeliveryMap[$userEntity->status_delivery] ?>">
                        <?= $userEntity->statusDeliveryText ?>
                    </span>
                        <?php endif ?>


                        <?php if ($userEntity->status == UserEntities::STATUS_WAIT): ?>
                            &nbsp;<?= Html::a(
                                '<i class="glyphicon glyphicon-ok"></i>',
                                ['/site/approve-gift', 'id' => $userEntity->id],
                                ['class' => 'btn btn-xs btn-success']
                            ) ?>
                            &nbsp;<?= Html::a(
                                '<i class="glyphicon glyphicon-remove"></i>',
                                ['/site/disapprove-gift', 'id' => $userEntity->id],
                                ['class' => 'btn btn-xs btn-danger']
                            ) ?>
                        <?php endif ?>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
    </div>
</div>