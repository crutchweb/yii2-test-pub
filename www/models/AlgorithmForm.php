<?php

namespace app\models;

use app\models\Algorithm;

/**
 * Class AlgorithmForm
 * @package app\models
 */
class AlgorithmForm extends Algorithm
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
}
