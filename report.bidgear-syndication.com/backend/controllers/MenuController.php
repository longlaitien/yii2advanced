<?php
namespace backend\controllers;

use backend\models\BackendController;
use backend\modules\system\forms\user\AdminsSearchForm;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * Class MenuController
 * @package backend\controllers
 */
class MenuController extends BackendController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $module = \Yii::$app->request->get('module');
        $controller = \Yii::$app->request->get('controller');
        $action = \Yii::$app->request->get('action');

        $menus = AdminsSearchForm::renderLeftMenu($module,$controller,$action);
        return [
            'success' => true,
            'content' => $this->renderAjax('index', [
                'menus' => $menus,
            ]),
        ];
    }
}
