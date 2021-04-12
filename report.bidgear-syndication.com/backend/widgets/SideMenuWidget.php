<?php
namespace backend\widgets;

use yii\base\Widget;

/**
 * Class SideMenuWidget
 * @package backend\widgets
 */
class SideMenuWidget extends Widget
{
    public function init()
    {
        if (!\Yii::$app->user->isGuest) {
            echo $this->render('side_menu_widget');
        }
    }
}