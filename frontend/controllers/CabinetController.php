<?php

namespace frontend\controllers;

use common\exceptions\EntityNotFoundException;
use common\models\form\LoginForm;
use common\models\User;
use common\models\UserEntities;
use common\services\EntityService;
use common\services\RaffleService;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
        $userEntities = $user->getUserEntities()->orderBy(['status'=>SORT_ASC])->all();

        return $this->render('index', [
            'user'=>$user,
            'userEntities'=>$userEntities
        ]);
    }
}