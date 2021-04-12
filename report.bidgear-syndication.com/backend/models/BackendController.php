<?php
namespace backend\models;


use yii\web\Controller;

/**
 * Class BackendController
 * @package backend\models
 */
class BackendController extends Controller
{
    public $layout = 'layout_main';
    public $enableCsrfValidation = true;

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            
            return true;
        }
        return false;
    }
}
