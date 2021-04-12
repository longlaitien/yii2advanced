<?php
/**
 * @var $this \backend\models\BackendView
 * @var $model LogSearchForm
 */
use yii\bootstrap\Html;
use backend\modules\system\forms\log\LogSearchForm;

$content = LogSearchForm::formatMessage($model);
$icon = $content['icon'];
$label = $content['label'];
$link = $content['link'];

$linkLog = \Yii::$app->urlManager->createUrl(['system/log/view','id'=>$model->_id]);
?>

<li>
    <div class="col1">
        <div class="cont" style="margin-right:0px;">
            <div class="cont-col1">
                <div class="label label-sm label-<?php echo $label;?>">
                    <i class="fa fa-<?php echo $icon;?>"></i>
                </div>
            </div>
            <div class="cont-col2">
                <div class="desc">
                    <a target="_blank" href="<?php echo $link;?>"><?php echo Html::encode($model->message);?></a>
                    <a style="color: #c1cbd0" href="<?php echo $linkLog;?>"><?php echo date('Y-m-d H:i:s',$model->created_time);?></a>
                </div>
            </div>
        </div>
    </div>
</li>
