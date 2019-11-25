<?php

namespace backend\controllers;

use common\models\search\UserEntities as UserEntitiesSearch;
use common\models\UserEntities;
use common\services\EntityService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PostController implements the CRUD actions for UserEntities model.
 */
class PostController extends Controller
{

    private $entityService;
    private $user;

    public function __construct($id, $module, EntityService $entityService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->entityService = $entityService;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
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

    public function actionProcess($id)
    {
        $this->entityService->process($id);
        $this->redirect(['index']);
    }

    public function actionArrive($id)
    {
        $this->entityService->send($id);
        $this->redirect(['index']);
    }

    public function actionDeliver($id)
    {
        $this->entityService->deliver($id);
        $this->redirect(['index']);
    }

    /**
     * Finds the UserEntities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserEntities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserEntities::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
