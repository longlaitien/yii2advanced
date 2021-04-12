<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => [
        'gii',
    ],
    /*'on beforeRequest' => function ($event) {
        if(!Yii::$app->request->isSecureConnection){
            $url = Yii::$app->request->getAbsoluteUrl();
            $url = str_replace('http:', 'https:', $url);
            Yii::$app->getResponse()->redirect($url);
            Yii::$app->end();
        }
    },*/
    'timezone'=>"America/New_York",
    'language' => 'en',
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],

    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath'=>'@common/runtime'
        ],
        'request' => [
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'this-is-report',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=bg_report',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 86400*31*12,
            'schemaCache' => 'cache',
        ],
    ],
    "params" => [
        "code.send_email"=>false,
        'code.server_email'=>'smtp_google',
    ],
];
