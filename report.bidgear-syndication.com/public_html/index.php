<?php
defined('YII_ENV') or define('YII_ENV', 'dev');
if (isset($_GET['debug']) && $_GET['debug'] == true) {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
} else {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
}

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../common/config/bootstrap.php');

//TODO load instance config
$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../common/config/main.php'),
    require(__DIR__ . "/../backend/config/main.php")
);
$application = new \yii\web\Application($config);
$application->run();