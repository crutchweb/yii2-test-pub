<?php

namespace app\controllers;

use Yii;
use app\controllers\ApiController;
use app\models\Algorithm;
use app\models\AlgorithmForm;

/**
 * Class AlgorithmApiController
 * @package app\controllers
 */
class AlgorithmApiController extends ApiController
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
     * This method get solution
     * example url: /api/1.0/algorithm/get-solution?access-token=<your access-token>
     * example body:
     * {
     *   "number": 1,
     *   "array": [5, 5, 1, 7, 2, 3, 5]
     * }
     *
     * @return array
     */
    public function actionGetSolution()
    {
        $response = [
            'error' => 'num and arr == null'
        ];

        $number = (int)Yii::$app->request->post('number');
        $str_array = Yii::$app->request->post('array');

        if (is_array($str_array)) {
            foreach ($str_array as $item) {
                $array[] = (int)$item;
            }
        }
        if ($number && $array) {
            $model = new AlgorithmForm();

            $user_id = Yii::$app->getUser()->id;
            $solution = $model->getSolution($number, $array);

            $model->user_id = $user_id;
            $model->number = $number;
            $model->array = serialize($array);
            $model->response = $solution;

            if ($model->validate()) {
                $model->save();
                $response = [
                    'success' => $solution
                ];
            } else {
                $response = [
                    'errors' => $model->errors
                ];
            }
        }

        return $response;
    }

    /**
     * This method deleting solution
     *
     * @return array
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteSolution()
    {
        $response = [
            'message' => false
        ];

        $id = (int)Yii::$app->request->post('id');
        $model = Algorithm::findOne(['id' => $id]);

        if ($model) {
            if($model->delete()) {
                $response = [
                    'message' => true
                ];
            }
        }

        return $response;
    }

    //TODO: Requires implementation
    public function actionPutSolution()
    {
        //init your code here
    }
}