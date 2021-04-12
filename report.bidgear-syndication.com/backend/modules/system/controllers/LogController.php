<?php
namespace backend\modules\system\controllers;

use backend\filters\BackendAccessRule;
use backend\models\BackendController;
use backend\modules\system\forms\log\RecordLogSearchForm;
use common\entities\user\Admins;
use yii\base\Exception;
use yii\filters\AccessControl;

/**
 * Class LogController
 * @package backend\modules\system\controllers
 */
class LogController extends BackendController
{
    /**
     * @inheritdoc
     */
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
                            'index','view',
                        ],
                        'allow' => true,
                        'roles' => [Admins::ROLE_BUSINESS],
                    ],
                ],
            ],

        ];
    }

    public function actionIndex()
    {
        $model = new RecordLogSearchForm();
        $model->load(\Yii::$app->request->get());
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionView($id){
        $model = RecordLogSearchForm::findOne($id);
        if($model!= null){
            return $this->render("view",[
                'model'=>$model,
            ]);
        }else{
            throw  new Exception("Not found");
        }
    }
}