<?php
use backend\models\BackendWidget;

/**
 * @var $this \backend\models\BackendView
 * @var $model \backend\modules\user\forms\stats\StatsAdsSearchForm
 * @var $start_date string
 * @var $label string
 * @var $type string
 * @var $data array
 * @var $target string
 */
$this->registerJsFile("@web/pages/js-admin/index.js", ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJs(<<<JS
function topImpress() {
        $.pjax.reload({
            container: "#pjax-top-impress",
            async: false,
            replace: false,
            data: {
                run_query: 1
            }
        });
    }
 jQuery(document).ready(function(){
    topImpress();
 });
JS
    , \yii\web\View::POS_END);

?>

<!-- BEGIN PORTLET-->
<div class="portlet light" style="height: 400px;">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-bar-chart font-green-sharp hide"></i>
            <span class="caption-subject font-green-sharp bold uppercase">Impressions</span>
            <span class="caption-helper"><?php echo $label; ?></span>
            
            <a target="<?php echo $target;?>"
               href="<?php echo Yii::$app->urlManager->createUrl(["/user/widget/top-impress", 'type' => BackendWidget::LAST_SEVEN_DAY, 'tag_id'=>'', 'source_id'=>$model->source_id]); ?>"
               class="btn btn-xs <?php echo ($type == BackendWidget::LAST_SEVEN_DAY) ? "blue" : "btn-default"; ?>">Seven
                days</a>
            <a target="<?php echo $target;?>"
               href="<?php echo Yii::$app->urlManager->createUrl(["/user/widget/top-impress", 'type' => BackendWidget::THIS_WEEK_DAY, 'tag_id'=>"", 'source_id'=>$model->source_id]); ?>"
               class="btn btn-xs <?php echo ($type == BackendWidget::THIS_WEEK_DAY) ? "blue" : "btn-default"; ?>">This
                week</a>
            <a target="<?php echo $target;?>"
               href="<?php echo Yii::$app->urlManager->createUrl(["/user/widget/top-impress", 'type' => BackendWidget::THIS_MONTH_DAY, 'tag_id'=>"", 'source_id'=>$model->source_id]); ?>"
               class="btn btn-xs <?php echo ($type == BackendWidget::THIS_MONTH_DAY) ? "blue" : "btn-default"; ?>">This
                month</a>
            <a target="<?php echo $target;?>"
               href="<?php echo Yii::$app->urlManager->createUrl(["/user/widget/top-impress", 'type' => BackendWidget::LAST_MONTH_DAY, 'tag_id'=>"", 'source_id'=>$model->source_id]); ?>"
               class="btn btn-xs <?php echo ($type == BackendWidget::LAST_MONTH_DAY) ? "blue" : "btn-default"; ?>">Last
                month</a>
            <a target="<?php echo $target;?>"
               href="<?php echo Yii::$app->urlManager->createUrl(["/user/widget/top-impress", 'type' => BackendWidget::THIS_YEAR_DAY, 'tag_id'=>"", 'source_id'=>$model->source_id]); ?>"
               class="btn btn-xs <?php echo ($type == BackendWidget::THIS_YEAR_DAY) ? "blue" : "btn-default"; ?>">This
                year</a>
            <a target="<?php echo $target;?>"
               href="<?php echo Yii::$app->urlManager->createUrl(["/user/widget/top-impress", 'type' => BackendWidget::LIFETIME_DAY, 'tag_id'=>"", 'source_id'=>$model->source_id]); ?>"
               class="btn btn-xs <?php echo ($type == BackendWidget::LIFETIME_DAY) ? "blue" : "btn-default"; ?>">Lifetime</a>
        </div>
        <div class="tools">
            <a onclick="topImpress()" href="javascript:;" class="reload">
            </a>
            <a href="javascript:;" class="remove">
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div id="site_statistics_loading">
            <img src="/admin/layout/img/loading.gif" alt="loading"/>
        </div>
        <?php \yii\widgets\Pjax::begin(['id' => 'pjax-top-impress']); ?>
        <?php

        if (is_array($data)) {
            $impressions = null;
            foreach ($data as $item) {
                $impress = $item['impress'];
                $impressions .= "['" . $item['date'] . "', " . $impress . "],";
            }
            $impressions .= "['L', 0],";
            //TODO: include file js
            $this->registerJs(
                <<< JS
                var impressions = [$impressions];
                jQuery(document).ready(function () {
                    IndexDashBoard.initImpressionsCharts(impressions);
                });
JS
                , \yii\web\View::POS_END);
        }
        ?>
        <div id="site_statistics_content" class="display-none">
            <div id="site_statistics" class="chart">
            </div>
            <div id="run-impress-dashboard-widget"></div>
        </div>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>
<!-- END PORTLET-->


