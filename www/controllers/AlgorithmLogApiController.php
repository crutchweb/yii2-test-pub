<?php

namespace app\controllers;

use Yii;
use app\controllers\ApiController;
use app\models\AlgorithmLogForm;

/**
 * Class AlgorithmLogApiController
 * @package app\controllers
 */
class AlgorithmLogApiController extends ApiController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // custom behaviors here

        return $behaviors;
    }

    /**
     * This method get log from user
     *
     * @return array
     */
    public function actionGetUserLog()
    {
        $user_id = (int)Yii::$app->request->post('user_id');
        $offset = (int)Yii::$app->request->post('offset');

        if ($user_id) {
            $model = new AlgorithmLogForm();
            $log = $model->getLogFromUser($user_id, $offset);

            if (count($log) > 0) {
                return ['log' => $log];
            }
        }

        return ['error' => 'User_id == null or dont search user'];
    }
}