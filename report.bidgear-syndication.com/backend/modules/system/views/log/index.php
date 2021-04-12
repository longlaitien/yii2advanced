<?php
/**
 * @var $this \backend\models\BackendView
 * @var $model \backend\modules\system\forms\log\RecordLogSearchForm
 */
use backend\modules\system\forms\log\RecordLogSearchForm;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = "Logs";
$this->subTitle = "management";


//TODO: includes file js
$this->registerCssFile("@web/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css");
$this->registerJsFile("@web/global/plugins/moment-with-locales.js", [
    'depends' => [\yii\web\JqueryAsset::className()]
]);
$this->registerJsFile("@web/global/plugins/bootstrap-daterangepicker/daterangepicker.js", [
    'depends' => [\yii\web\JqueryAsset::className()]
]);
$this->registerJsFile("@web/pages/js-admin/log-list.js?v=1.0.1", ['depends' => [\yii\web\JqueryAsset::className()]]);

$csrf = \Yii::$app->request->csrfToken;
$this->registerJs(<<<JS
 var logList;
 jQuery(document).ready(function(){
    logList = new LogList();
 });
JS
    , \yii\web\View::POS_END);

?>
<div class="portlet light" id="show-log">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-clock-o font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">
                <?php echo $this->title ?>
            </span>
            <span class="caption-helper">
                <?php echo $this->subTitle ?>
            </span>
        </div>
    </div>
    <div class="portlet-body">
        <?php echo $this->render('_search', ['model' => $model]); ?>
        <?php Pjax::begin(['id'=>'pjax-log']);?>
        <div class="row table-responsive">
            <div class="col-md-12">
                <?php Pjax::begin(); ?>
                <?php
                echo GridView::widget([
                    'id' => 'grid-view-log',
                    'dataProvider' => $model->search(),
                    'filterModel' => null,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'options' => [
                                'style' => 'width:5px'
                            ],
                        ],
                        [
                            'attribute' => 'message',
                            'format' => 'raw',
                            'value' => function (RecordLogSearchForm $data) {
                                return $data->formatMessageView();
                            },
                            'options' => [
                                'class' => 'col-md-8'
                            ],
                        ],
                        [
                            'attribute' => 'category',
                            'format' => 'raw',
                            'value' => function (RecordLogSearchForm $data) {
                                return Html::encode($data->category);
                            },
                            'contentOptions' => [
                                'style' => 'width: 100px'
                            ]
                        ],
                        [
                            'attribute' => 'type',
                            'format' => 'raw',
                            'value' => function (RecordLogSearchForm $data) {
                                return Html::encode($data->type);
                            },
                            'contentOptions' => [
                                'style' => 'width: 100px'
                            ]
                        ],
                        [
                            'attribute' => 'created_time',
                            'format' => 'raw',
                            'value' => function (RecordLogSearchForm $data) {
                                return date('Y-m-d H:i:s', $data->created_time);
                            },
                            'contentOptions' => [
                                'style' => 'width: 140px'
                            ]
                        ],
                        [
                            'attribute' => 'created_time',
                            'header' => 'Action',
                            'format' => 'raw',
                            'value' => function (RecordLogSearchForm $data) {
                                return Html::a("<i class='fa fa-eye'></i> Detail",
                                    \Yii::$app->urlManager->createUrl([
                                        "/system/log/view",
                                        'id' => $data->log_id
                                    ]), [
                                        'class' => 'btn btn-xs blue',
                                    ]);
                            },
                            'contentOptions' => [
                                'style' => 'width: 140px'
                            ]
                        ]
                    ],
                    'options' => [
                        'class' => '',
                    ],
                    'showHeader' => true,
                    'showFooter' => false,
                    'layout' => '{items}{summary}{pager}',
                    'filterSelector' => '',
                ]);
                \yii\widgets\Pjax::end();
                ?>
            </div>
        </div>
        <?php Pjax::end();?>
    </div>
</div>