<?php
namespace backend\widgets;


use yii\base\Widget;

/**
 * Class HeaderUserMenuWidget
 * @package backend\widgets
 */
class HeaderUserMenuWidget extends Widget
{
    public function init()
    {
        echo $this->render('header_user_menu_widget');
    }
}