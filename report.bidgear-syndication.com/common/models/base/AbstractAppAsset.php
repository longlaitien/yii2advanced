<?php
namespace common\models\base;


use yii\helpers\ArrayHelper;
use yii\web\AssetBundle;

/**
 * Class AbstractAppAsset
 * @package common\models\base
 */
class AbstractAppAsset extends AssetBundle
{
    public $script = [];
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [];
    public $js = [];

    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];

    public function registerAssetFiles($view)
    {
        if (isset($this->script['css'])) {
            $this->css = ArrayHelper::merge($this->css, $this->script['css']);
        }
        if (isset($this->script['js'])) {
            $this->js = ArrayHelper::merge($this->js, $this->script['js']);
        }
        parent::registerAssetFiles($view);
    }
}