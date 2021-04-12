<?php
namespace backend\models;

use yii\helpers\Html;

/**
 * Class BackendHtml
 * @package backend\models
 */
class BackendHtml extends Html
{
    public static function parseJsMessage($message)
    {
        $message = trim($message);
        $message = preg_replace("/\r|\n/", "", $message);
        $message = str_replace("'", "\\\"", $message);
        return $message;
    }

    //TODO for virtual frontend login
    public static function formatLoginUser($email)
    {
        return Html::a(Html::encode($email),
            \Yii::$app->urlManager->createAbsoluteUrl([
                '/hehe/frontend-login',
                'token' => sha1(uniqid('token')),
                'time' => time(),
                'email' => $email,

            ]), [
                'target' => '_blank',
                'data-pjax' => 0
            ]
        );
    }

}