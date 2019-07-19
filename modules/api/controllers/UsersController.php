<?php

namespace app\modules\api\controllers;

use app\controllers\BaseApiController;
use app\models\Users;
use yii\filters\AccessControl;
use Yii;

/**
 * Default controller for the `api` module
 */
class UsersController extends BaseApiController
{
    public $modelClass = 'app\models\Users';
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];
        return $behaviors;
    }

    public function actionIndex(){
        $model = Users::find()->All();
        return $model;
    }
}
