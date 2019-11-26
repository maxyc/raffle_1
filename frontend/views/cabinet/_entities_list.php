<?php

use common\models\UserEntity;
use yii\helpers\Html;

/** @var $list []] */
/** @var $item UserEntity */

$statusesMap = [
    UserEntity::STATUS_WAIT => 'info',
    UserEntity::STATUS_APPROVE => 'success',
    UserEntity::STATUS_DISAPPROVE => 'danger',
];

$statusesDeliveryMap = [
    UserEntity::STATUS_DELIVERY_WAIT => 'default',
    UserEntity::STATUS_DELIVERY_PROCESS => 'primary',
    UserEntity::STATUS_DELIVERY_ARRIVED => 'success',
    UserEntity::STATUS_DELIVERY_DELIVERED => 'success',
];
?>

<ul class="list-group">
    <?php foreach ($list as $item): ?>
        <li class="list-group-item">
            <?= $item->entity->name ?>
            <span class="label label-<?= $statusesMap[$item->status] ?>">
                <?= $item->statusText ?>
            </span>

            <?php if ($item->isApproved()): ?>
                <span class="label label-<?= $statusesDeliveryMap[$item->status_delivery] ?>">
                    <?= $item->statusDeliveryText ?>
                </span>
            <?php endif ?>


            <?php if ($item->isWait()): ?>
                &nbsp;<?= Html::a(
                    '<i class="glyphicon glyphicon-ok"></i>',
                    ['/gift/approve', 'id' => $item->id],
                    ['class' => 'btn btn-xs btn-success']
                ) ?>
                &nbsp;<?= Html::a(
                    '<i class="glyphicon glyphicon-remove"></i>',
                    ['/gift/disapprove', 'id' => $item->id],
                    ['class' => 'btn btn-xs btn-danger']
                ) ?>
            <?php endif ?>
        </li>
    <?php endforeach ?>
</ul>