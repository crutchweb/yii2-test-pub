<?php

namespace app\controllers;

use yii\rest\Controller;
use yii\filters\auth\QueryParamAuth;
use yii\web\Response;

/**
 * Class ApiController
 * @package app\controllers
 */
class ApiController extends Controller
{
    public $modelClass = 'app\models\User';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = QueryParamAuth::className();
        $behaviors['authenticator']['tokenParam'] = 'access-token';

        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }
}