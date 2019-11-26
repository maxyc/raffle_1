<?php

namespace frontend\controllers;

use common\models\Option;
use common\models\User;
use common\services\EntityService;
use common\services\MoneyService;
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
    private $moneyService;
    private $user;

    public function __construct(
        $id,
        $module,
        RaffleService $raffleService,
        EntityService $entityService,
        MoneyService $moneyService,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->raffleService = $raffleService;
        $this->entityService = $entityService;
        $this->moneyService = $moneyService;
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
        $userMoneys = $user->getUserMoneys()->orderBy(['status' => SORT_ASC])->all();

        $convertPercent = Option::find()->coefficient()->select(['value'])->scalar();

        return $this->render(
            'index',
            [
                'user' => $user,
                'userEntities' => $userEntities,
                'userMoneys' => $userMoneys,
                'convertPercent' => $convertPercent,
            ]
        );
    }

}