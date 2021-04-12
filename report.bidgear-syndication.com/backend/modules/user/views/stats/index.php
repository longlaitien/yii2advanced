<?php

use backend\modules\user\forms\stats\StatsAdsSearchForm;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this \backend\models\BackendView */
/* @var $dataProvider yii\data\ActiveDataProvider */
/** @var $model StatsAdsSearchForm */

$this->title = 'Stats Ads';

//TODO: includes file js
$this->registerCssFile("@web/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css");
$this->registerJsFile("@web/global/plugins/moment-with-locales.js", [
    'depends' => [\yii\web\JqueryAsset::className()]
]);
$this->registerJsFile("@web/global/plugins/bootstrap-daterangepicker/daterangepicker.js", [
    'depends' => [\yii\web\JqueryAsset::className()]
]);

$csrf = \Yii::$app->request->csrfToken;
$this->registerJs(<<<JS
 jQuery(document).ready(function(){
    $('#date_ranger').daterangepicker({
        format: 'YYYY-MM-DD',
        separator: ' to ',
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });
 });
JS
    , \yii\web\View::POS_END);
?>

<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-folder-o font-green-sharp"></i>
            <span class="caption-subject font-green-sharp bold uppercase">Stats Ads</span>
            <span class="caption-helper">List</span>
        </div>

        <div class="tools">
        </div>
        <div class="actions">
            
        </div>
    </div>
    <div class="portlet-body">
        <?php echo $this->render('_search', ['model' => $model]); ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="category-search-form-index table-responsive">

                    <?php Pjax::begin(['id' => 'pjax-grid-stats-ads',]); ?>
                    <?php echo GridView::widget([
                        'dataProvider' => $model->search(),
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn',
                                'options' => ['style' => 'width:30px']
                            ],
                            [
                                'attribute' => 'ads_id',
                                'format' => 'raw',
                                'value' => function (StatsAdsSearchForm $data) {
                                    return $data->ads_id;
                                },
                                'options' => ['style' => 'width:100px;']
                            ],
                            [
                                'attribute' => 'ads_campaign_id',
                                'format' => 'raw',
                                'value' => function (StatsAdsSearchForm $data) {
                                    return $data->ads_campaign_id;
                                },
                                'options' => ['style' => 'width:100px;']
                            ],
                            [
                                'attribute' => 'bg_campaign_id',
                                'format' => 'raw',
                                'value' => function (StatsAdsSearchForm $data) {
                                    return $data->bg_campaign_id;
                                },
                                'options' => ['style' => 'width:100px;']
                            ],
                            [
                                'attribute' => 'total_imps',
                                'format' => 'raw',
                                'value' => function (StatsAdsSearchForm $data) {
                                    return $data->total_imps;
                                },
                                'options' => ['style' => 'width:100px;'],
                                'contentOptions' => ['class' => 'text-right'],
                            ],
                            [
                                'attribute' => 'paid_imps',
                                'format' => 'raw',
                                'value' => function (StatsAdsSearchForm $data) {
                                    return $data->paid_imps;
                                },
                                'options' => ['style' => 'width:100px;'],
                                'contentOptions' => ['class' => 'text-right'],
                            ],
                            [
                                'attribute' => 'rev',
                                'format' => 'raw',
                                'value' => function (StatsAdsSearchForm $data) {
                                    return $data->rev;
                                },
                                'options' => ['style' => 'width:100px;'],
                                'contentOptions' => ['class' => 'text-right'],
                            ],
                            [
                                'attribute' => 'date',
                                'format' => 'raw',
                                'value' => function (StatsAdsSearchForm $data) {
                                    return $data->date;
                                },
                                'options' => ['style' => 'width:100px;']
                            ],
                            
                        ],
                        'layout' => '{pager}{summary}{items}{summary}{pager}',
                    ]);
                    Pjax::end();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

