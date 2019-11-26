<?php

namespace frontend\controllers;

use common\models\UserEntity;
use common\services\EntityService;
use yii\base\ErrorException;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Site controller
 */
class GiftController extends Controller
{
    private $service;

    public function __construct($id, $module, EntityService $service, $config = [])
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
     * @return UserEntity|null
     * @throws ErrorException
     */
    private function findModel($id)
    {
        $userEntities = UserEntity::findOne($id);
        if (!$userEntities) {
            throw new ErrorException('User entity #' . $id . ' not found');
        }

        return $userEntities;
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
}