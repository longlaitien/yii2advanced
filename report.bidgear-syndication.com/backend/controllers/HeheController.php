<?php

namespace backend\controllers;

use backend\forms\BackendLoginForm;
use backend\forms\ChangePasswordForm;
use backend\forms\ChangePasswordRequiredForm;
use backend\forms\CheckAdsForm;
use backend\forms\UpdateByDateForm;
use backend\models\BackendController;
use Yii;
use yii\base\Exception;
use yii\base\UserException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Cookie;
use yii\web\HttpException;

/**
 * Class HeheController
 * @package backend\controllers
 */
class HeheController extends BackendController
{
    public $defaultAction = 'hello';

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
                            'login-hehe', 'error', 'hello', 'test',
                            "check-ads-server",
                            "slack-ads-server",
                        ],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'logout', 'index',
                            "profile", 'change-pass-required',
                            "update-by-date",
                            "mdn-update-by-date",

                            //TODO for fronted-user-login
                            "change-source"
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }

    public function actionCheckAdsServer()
    {
        set_time_limit(0);
        $key = \Yii::$app->request->get('key');
        $send = \Yii::$app->request->get('send');
        if ($key != "jd3t2") {
            return false;
        }
        CheckAdsForm::checkAds($send);
    }

    public function actionUpdateByDate()
    {
        $date = date("Y-m-d");
        $partner = '';
        $model = new UpdateByDateForm();
        if ($model->load(\Yii::$app->request->post())) {
            $date = explode(" to ", $model->date);
            $date = $date[0];
            if (!$date) {
                $date = date("Y-m-d");
            }
            $partner = implode(',', $model->partner);
        }
        return $this->render("update-by-date", [
            'model' => $model,
            'date' => $date,
            'partner' => $partner,
        ]);
    }

    public function actionMdnUpdateByDate()
    {
        $date = date("Y-m-d");
        $partner = '';
        $model = new UpdateByDateForm();
        if ($model->load(\Yii::$app->request->post())) {
            $date = explode(" to ", $model->date);
            $date = $date[0];
            if (!$date) {
                $date = date("Y-m-d");
            }
            $partner = implode(',', $model->partner);
        }
        return $this->render("mdn-update-by-date", [
            'model' => $model,
            'date' => $date,
            'partner' => $partner,
        ]);
    }

    public function actionChangeSource($source = 2)
    {
        $list = [1, 2, 3, 4];
        $source = (int)$source;
        if (!in_array($source, $list)) {
            $source = 2;
        }
        //TODO set cookie
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new Cookie([
            'name' => 'mdnSource',
            "value" => $source,
            'expire' => time() + 86400 * 365,
        ]));
        $this->redirect("/hehe/index");
    }

    public function actionHello()
    {
        if (!\Yii::$app->user->isGuest) {
            $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['hehe/index']));
        }
        $this->layout = false;
        return $this->render('hello');
    }

    public function actionIndex()
    {
        return $this->render('dashboard');
    }

    public function actionProfile()
    {
        $changePassForm = new ChangePasswordForm();
        if ($changePassForm->load(\Yii::$app->request->post()) &&
            $changePassForm->toChangePassword()
        ) {
            $this->redirect("logout");
        }
        return $this->render("profile/index", [
            'changePassForm' => $changePassForm
        ]);
    }

    public function actionChangePassRequired()
    {
        $changePassForm = new ChangePasswordRequiredForm();
        if ($changePassForm->load(\Yii::$app->request->post()) &&
            $changePassForm->toChangePassword()
        ) {
            $this->redirect("logout");
        }
        return $this->render("profile/change-pass-required", [
            'changePassForm' => $changePassForm
        ]);
    }

    /**
     * @inheritdoc
     */
    public function actionError()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            $this->redirect(['index']);
        }

        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        } else {
            $code = $exception->getCode();
        }
        if ($exception instanceof Exception) {
            $name = $exception->getName();
        } else {
            $name = 'Error';
        }
        if ($code) {
            $name .= " (#$code)";
        }

        if ($exception instanceof UserException) {
            $message = $exception->getMessage();
        } else {
            $message = 'An internal server error occurred.';
        }

        if (Yii::$app->getRequest()->getIsAjax()) {
            return "$name: $message";
        } else {
            if (Yii::$app->user->isGuest) {
                $this->layout = "layout_error";
            }
            return $this->render('error', [
                'name' => $name,
                'message' => $message,
                'exception' => $exception,
            ]);
        }
    }

    public function actionLoginHehe()
    {
        if (!\Yii::$app->user->isGuest) {
            $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['hehe/index']));
        }
        $this->layout = "layout_login";
        //TODO login form
        $loginForm = new BackendLoginForm();
        if ($loginForm->load(\Yii::$app->request->post()) && $loginForm->login()) {
            $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['hehe/index']));
        }

        return $this->render('login/index', [
            'loginForm' => $loginForm,
        ]);
    }

    public function actionLogout()
    {
        if (Yii::$app->user->logout()) {
            return $this->redirect("login-hehe");
        }
        return $this->goBack();
    }
}
