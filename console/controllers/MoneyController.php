<?php

namespace backend\controllers;

use common\integrations\FakeApiBankImplementation;
use common\models\UserMoney;
use common\services\MoneyService;
use yii\web\Controller;

/**
 * PostController implements the CRUD actions for UserEntities model.
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
     * @param int $limit Processed items
     */
    public function send($limit = 5)
    {
        $list = UserMoney::find()->waitSend()->limit($limit)->all();
        foreach ($list as $item) {
            $this->service->send($item, new FakeApiBankImplementation());
        }
    }

    /**
     * @param int $limit Processed items
     */
    public function check($limit = 5)
    {
        $list = UserMoney::find()->arrived()->limit($limit)->all();
        foreach ($list as $item) {
            $this->service->check($item, new FakeApiBankImplementation());
        }
    }
}
