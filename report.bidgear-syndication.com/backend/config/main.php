<?php
return [
    'id' => 'backend',
    'defaultRoute' => 'hehe/hello',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'modules' => [
        'system' => [
            "class" => \backend\modules\system\SystemModule::className(),
            'layoutPath' => dirname(__DIR__) . '/views/layouts',
        ],
        'user' => [
            "class" => \backend\modules\user\UserModule::className(),
            'layoutPath' => dirname(__DIR__) . '/views/layouts',
        ],
    ],
    'components' => [
        'session' => [
            'name' => 'PHPBACKSESSIDREPORT',
            'savePath' =>dirname( __DIR__) . '/runtime/tmp',
        ],
        'user' => [
            'identityClass' => \backend\models\BackendUserIdentity::className(),
            'enableAutoLogin' => true,
            'loginUrl'=>array('hehe/login-hehe'),
        ],
        'view' => [
            'class' => \backend\models\BackendView::className(),
        ],
        'errorHandler' => [
            'errorAction' => 'hehe/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'hehe/hello',
            ]
        ],
    ],
];
