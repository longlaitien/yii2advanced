<?php

namespace console\controllers;

use yii\console\Controller;

/**
 * Site controller
 *
 * @property string $p
 * @property string $d
 */
class SiteController extends Controller
{
    public $enableCsrfValidation = false;

    public $p;
    public $d;

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function options($actionID)
    {
        return array_merge(parent::options($actionID), [
            'p', 'd'
        ]);
    }

}
