<?php

namespace app\models;

use app\models\Log;

/**
 * Class AlgorithmLogForm
 * @package app\models
 */
class AlgorithmLogForm extends Log
{
    /**
     * @inheritdoc
     */
    public function rules() {
        $parentRules = parent::rules();
        return $parentRules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        $parentlabels = parent::attributeLabels();
        return $parentlabels;
    }

    /**
     * This method get log from user id
     *
     * @param int $user_id
     * @param int $offset
     * @return array|bool|\yii\db\ActiveRecord[]
     */
    public function getLogFromUser(int $user_id, int $offset = 0)
    {
        if ($user_id) {
            $query = Log::find()
                ->where(['user_id' => $user_id])
                ->limit(5);

            if ($offset > 0) {
                $query->offset($offset);
            }

            $model = $query->asArray()->all();

            return $model;
        }

        return false;
    }

    //TODO: Requires implementation
    public function getLogFromMethod()
    {
        //init your code here
    }

    //TODO: Requires implementation
    public function getUsersFromMethod()
    {
        //init your code here
    }
}
