<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\console\Request;
use app\models\AlgorithmLogForm;

/**
 * Class Algorithm
 * @package app\models
 */
class Algorithm extends ActiveRecord
{

    public $user_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%algorithm}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'safe'],
            [['id', 'number', 'user_id'], 'integer'],
            [['array', 'response'], 'trim'],
            [['array', 'response'], 'string'],
            ['timestamp', 'date', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'number' => 'Число',
            'array' => 'Массив',
            'response' => 'Ответ',
            'timestamp' => 'Дата создания',
        ];
    }

    /**
     *  This method search position in array
     *
     * @param int $number
     * @param array $array
     * @return int
     */
    public function getSolution(int $number, array $array) : int
    {
        $size = count($array);

        $index_l = 0; // left index
        $index_r = $size - 1; // right index from end array

        $position = 0; // position for delimeter

        for ($z = 0; $z < $size; $z++) {

            /*
             * the number of numbers on the left side == $number, and the number of numbers !=$number on the right side;
             */
            $left_num = $right_num = $position;

            if ($index_l > $index_r){ // if left index > right index, then stop
                break;
            }

            if ($array[$index_l] == $number) {
                $left_num++;
            }

            if ($array[$index_r] != $number) {
                $right_num++;
            }

            /*
             * shift the right index, if left numbers > right numbers
             */
            if ($left_num > $right_num) {
                $index_r--;
                continue;
            }

            /*
             * shift the left index, if left numbers < right numbers
             */
            if ($left_num < $right_num) {
                $index_l++;
                continue;
            }

            /*
             * else, if left numbers == right numbers, shift both indices
             */
            $index_l++;
            $index_r--;
            $position = $left_num;
        }

        /*
         * if position, echo index, else -1
         */
        return $position ? $index_l : -1;
    }

    /**
     * @inheritdoc
     *
     * This method save log from algorithm
     */
    public function afterSave($insert, $changedAttributes)
    {
        $request = new Request();
        $modelLog = new AlgorithmLogForm();

        $modelLog->user_id = $this->user_id;
        $modelLog->algorithm_id = $this->id;
        $modelLog->method = Yii::$app->controller->id.'/'.Yii::$app->controller->action->id;

        if ($request->getIsConsoleRequest()) {
            $modelLog->request = serialize($request->getParams());
        } else {
            $modelLog->request = serialize(Yii::$app->request->post());
        }

        $modelLog->response = serialize($this->response);
        $modelLog->save();

        return parent::afterSave($insert, $changedAttributes);
    }
}
