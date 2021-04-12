<?php
namespace backend\modules\system\controllers;

use backend\filters\BackendAccessRule;
use backend\models\BackendController;
use backend\modules\system\forms\user\AdminForm;
use backend\modules\system\forms\user\AdminsSearchForm;
use common\entities\user\Admins;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * Class AdminController
 * @package backend\modules\system\controllers
 */
class AdminController extends BackendController
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
                            'index', 'create', 'update', 'view',
                            'switch-status',
                        ],
                        'allow' => true,
                        'roles' => [Admins::ROLE_ADMIN],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['POST', 'GET'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $account = new AdminsSearchForm();
        $account->load(\Yii::$app->request->get());
        return $this->render('index', [
            'model' => $account,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    public function actionCreate()
    {
        $user = new AdminForm();
        if ($user->load(\Yii::$app->request->post())
            && $user->toSave()
        ) {
            return $this->redirect(['view', 'id' => $user->user_id]);
        }
        return $this->render('create', [
            'model' => $user,
            'user' => \Yii::$app->user->identity,
        ]);
    }

    public function actionUpdate($id)
    {
        /**
         * @var $user AdminForm
         */
        $user = AdminForm::findOne($id);
        if ($user != null) {
            if ($user->role == Admins::ROLE_ADMIN && $user->user_id != \Yii::$app->user->getId()) {
                throw  new ForbiddenHttpException('You can not permission change other admin');
            }
            /**
             * @var $user AdminForm
             */
            if ($user->load(\Yii::$app->request->post())
                && $user->toSave()
            ) {
                return $this->redirect(['view', 'id' => $user->user_id]);
            }
            return $this->render('update', [
                'model' => $user,
                'user' => \Yii::$app->user->identity,
            ]);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @return null|AdminsSearchForm
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = AdminsSearchForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}