<?php

namespace frontend\controllers;

use common\models\User;
use common\services\EntityService;
use common\services\RaffleService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Site controller
 */
class CabinetController extends Controller
{
    private $raffleService;
    private $entityService;
    private $user;

    public function __construct($id, $module, RaffleService $raffleService, EntityService $entityService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->raffleService = $raffleService;
        $this->entityService = $entityService;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $user = User::findOne(Yii::$app->user->getId());
        $userEntities = $user->getUserEntities()->orderBy(['status' => SORT_ASC])->all();

        return $this->render(
            'index',
            [
                'user' => $user,
                'userEntities' => $userEntities
            ]
        );
    }
}