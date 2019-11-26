<?php

use common\models\UserMoney;
use yii\helpers\Html;

/** @var $list []] */
/** @var $item UserMoney */

$statusesMap = [
    UserMoney::STATUS_WAIT => 'info',
    UserMoney::STATUS_APPROVE => 'success',
    UserMoney::STATUS_DISAPPROVE => 'danger',
];

$statusesDeliveryMap = [
    UserMoney::STATUS_DELIVERY_WAIT => 'default',
    UserMoney::STATUS_DELIVERY_PROCESS => 'primary',
    UserMoney::STATUS_DELIVERY_ARRIVED => 'success',
    UserMoney::STATUS_DELIVERY_DELIVERED => 'success',
];
?>

<ul class="list-group">
    <?php foreach ($list as $item): ?>
        <li class="list-group-item">
            <?= $item->money ?> монет
            <span class="label label-<?= $statusesMap[$item->status] ?>">
                <?= $item->statusText ?>
            </span>

            <?php if ($item->isApproved()): ?>
                <span class="label label-<?= $statusesDeliveryMap[$item->status_delivery] ?>">
                    <?= $item->statusDeliveryText ?>
                </span>
            <?php endif ?>


            <?php if ($item->isWait()): ?>
                <?= Html::a(
                    '<i class="glyphicon glyphicon-ok"></i>',
                    ['/money/approve', 'id' => $item->id],
                    ['class' => 'btn btn-xs btn-success']
                ) ?>
                <?= Html::a(
                    '<i class="glyphicon glyphicon-remove"></i>',
                    ['/money/disapprove', 'id' => $item->id],
                    ['class' => 'btn btn-xs btn-danger']
                ) ?>
                <?= Html::a(
                    '<i class="glyphicon glyphicon-refresh"></i>',
                    ['/money/convert', 'id' => $item->id],
                    ['class' => 'btn btn-xs btn-default']
                ) ?>
            <?php endif ?>
        </li>
    <?php endforeach ?>
</ul>