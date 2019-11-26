<?php

namespace backend\controllers;

use common\integrations\FakePostBankImplementation;
use common\models\search\UserEntity as UserEntitiesSearch;
use common\models\UserEntity;
use common\services\EntityService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PostController implements the CRUD actions for UserEntities model.
 */
class PostController extends Controller
{

    private $service;
    private $user;

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
     * Lists all UserEntities models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserEntitiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * @param $id
     * @throws NotFoundHttpException
     */
    public function actionProcess($id)
    {
        $this->service->process($this->findModel($id));
        $this->redirect(['index']);
    }

    /**
     * @param $id
     * @throws NotFoundHttpException
     */
    public function actionArrive($id)
    {
        $this->service->send($this->findModel($id), new FakePostBankImplementation());
        $this->redirect(['index']);
    }

    /**
     * @param $id
     * @throws NotFoundHttpException
     */
    public function actionDeliver($id)
    {
        $this->service->check($this->findModel($id), new FakePostBankImplementation());
        $this->redirect(['index']);
    }

    /**
     * Finds the UserEntities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserEntity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserEntity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
