<?php
namespace backend\widgets;

use yii\base\Widget;

/**
 * Class NotifyWidget
 * @package backend\widgets
 */
class NotifyWidget extends Widget
{
    public function init()
    {
        echo $this->render('notify_widget', [
        ]);
    }
}