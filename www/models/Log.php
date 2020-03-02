<?php

namespace app\models;
use yii\db\ActiveRecord;

/**
 * Class Log
 * @package app\models
 */
class Log extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'safe'],
            [['id', 'user_id'], 'integer'],
            [['request', 'response', 'method'], 'trim'],
            [['request', 'response', 'method'], 'string'],
            ['timestamp', 'date', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'id',
            'user_id'       => 'ID пользователя',
            'algorithm_id'  => 'ID алгоритма',
            'method'        => 'Название метода',
            'request'       => 'Запрос',
            'response'      => 'Ответ',
            'timestamp'     => 'Дата создания',
        ];
    }
}
