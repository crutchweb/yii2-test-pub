<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\AlgorithmForm;
use app\models\User;

/**
 * Class GetSolutionController
 * @package app\commands
 */
class GetSolutionController extends Controller
{
    public $number;
    public $array;
    public $user_id;

    /**
     * this method gets solution and render her in console
     *
     * @param int $number
     * @param string $array
     * @param int $user_id
     * @return int
     */
    public function actionIndex(int $number = 0, string $array = '', int $user_id = 0)
    {
        $number = (int)$number;

        $str = str_replace(['[', ']'], '', $array);

        $str_array = explode(',', $str);

        $array = [];

        foreach ($str_array as $item) {
            $array[] += (int)$item;
        }

        $model = new AlgorithmForm();

        $user = User::findOne($user_id);

        if ($user) {
            $model->user_id = $user_id;
        } else {
            $model->user_id = null;
            echo 'User with this id does not exist, user_id = null' . "\n";
        }

        $solution = $model->getSolution($number, $array);

        $model->number = $number;
        $model->array = serialize($array);
        $model->response = $solution;

        if ($model->validate()) {
            $model->save();
            $response = $solution;
        } else {
            $response = $model->errors;
        }

        echo $response . "\n";

        return ExitCode::OK;
    }
}
