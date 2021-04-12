<?php

namespace backend\modules\user\controllers;

use backend\filters\BackendAccessRule;
use backend\models\BackendController;
use backend\modules\user\forms\stats\StatsAdsSearchForm;
use common\entities\user\Admins;
use yii\filters\AccessControl;

/**
 * Class StatsController
 * @package backend\modules\user\controllers
 */
class StatsController extends BackendController
{
    //TODO: behaviors
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => BackendAccessRule::className(),
                ],
                'rules' => [
                    [
                        'actions' => [
                            'index',
                        ],
                        'allow' => true,
                        'roles' => [Admins::ROLE_BUSINESS],
                    ],
                ],
            ],
        ];
    }

    //TODO: actionIndex
    public function actionIndex()
    {
        $model = new StatsAdsSearchForm();
        $model->load(\Yii::$app->request->get());
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}