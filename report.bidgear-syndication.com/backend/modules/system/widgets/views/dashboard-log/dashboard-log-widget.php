<?php
/**
 * @var $this \backend\models\BackendView
 */
use yii\widgets\ListView;

$this->registerJs(<<<JS
function dashboardLog() {
        Metronic.blockUI({
                animate: true,
                target: '#pjax-dashboard-log',
            });
        $.pjax.reload({
            container: "#pjax-dashboard-log",
            async: false,
            replace: false,
            data: {
                run_query: 1
            }
        }).done(function() {
          Metronic.initAjax();
          Metronic.unblockUI('#place-dashboard-log');
        });
    }
 jQuery(document).ready(function(){
    dashboardLog();
 });
JS
    , \yii\web\View::POS_END);
?>
<?php \yii\widgets\Pjax::begin(['id'=>'pjax-dashboard-log']);?>

<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-share font-blue-steel hide"></i>
            <span class="caption-subject font-blue-steel bold uppercase">Recent Activities</span>
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse">
            </a>
            <a onclick="dashboardLog()" href="javascript:;" class="reload">
            </a>
            <a href="javascript:;" class="remove">
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div id="place-dashboard-log" class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
            <?php
            if($data){
                echo ListView::widget([
                    'dataProvider' => $data,
                    'showOnEmpty' => true,
                    "itemView" => "_log_item",
                    "layout" => "<ul class='feeds'>{items}</ul>",
                ]);
            }
            ?>
        </div>
        <div class="scroller-footer">
            <div class="btn-arrow-link pull-right">
                <a href="<?php echo Yii::$app->urlManager->createUrl(["/system/log/index"]);?>">See All Records</a>
                <i class="icon-arrow-right"></i>
            </div>
        </div>
    </div>
</div>
<?php \yii\widgets\Pjax::end();?>