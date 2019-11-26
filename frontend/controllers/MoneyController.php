<?php

namespace frontend\controllers;

use common\models\Option;
use common\models\User;
use common\models\UserMoney;
use common\services\MoneyService;
use Yii;
use yii\base\ErrorException;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Site controller
 */
class MoneyController extends Controller
{
    private $service;

    public function __construct($id, $module, MoneyService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
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

    /**
     * @param $id
     * @return string
     * @throws ErrorException
     */
    public function actionDisapprove($id)
    {
        $this->service->disapprove($this->findModel($id));
        return $this->render('disapprove');
    }

    /**
     * @param $id
     * @return UserMoney|null
     * @throws ErrorException
     */
    private function findModel($id)
    {
        $userMoney = UserMoney::findOne($id);
        if (!$userMoney) {
            throw new ErrorException('User money record #' . $id . ' not found');
        }

        return $userMoney;
    }

    /**
     * @param $id
     * @return string
     * @throws ErrorException
     */
    public function actionApprove($id)
    {
        $this->service->approve($this->findModel($id));
        return $this->render('approve');
    }

    /**
     * @param $id
     * @return string
     * @throws ErrorException
     */
    public function actionConvert($id)
    {
        $user = User::findOne(Yii::$app->user->getId());
        $percent = Option::find()->coefficient()->select(['value'])->scalar();

        $this->service->convert($percent, $this->findModel($id), $user);
        return $this->render('convert');
    }
}