<?php
/**
 * @var $this \backend\models\BackendView
 * @var $model \backend\forms\UpdateByDateForm
 * @var $date string
 * @var $partner string
 */

use yii\bootstrap\ActiveForm;
use common\util\CommonBidgear;
use yii\helpers\Html;

$this->title = "Update by date";
$this->subTitle = "overview";

$partnerList = [
    CommonBidgear::PULSEPOINT_ADS => "PP",
    CommonBidgear::CRITEO_ADS => "Criteo",
    CommonBidgear::MGID_ADS => "MGID",
    CommonBidgear::CEDATO_ADS => "Cedato",
    CommonBidgear::BW_ADS => "BW",
    CommonBidgear::SEKINDO_ADS => "Sekindo",
    CommonBidgear::SEKINDO_HEADER_ADS => "Sekindo HB",
    CommonBidgear::CRITEO_HEADER_ADS => "Criteo HB",
    CommonBidgear::BB_ADS => "Bebi",
    CommonBidgear::ADSTERRA_ADS => "Adsterra",
    CommonBidgear::STREAMRAIL_ADS => "SR",
    CommonBidgear::STREAMRAIL_2_ADS => "SR2",
    CommonBidgear::DISTRICTM_ADS => "DistrictM",
    CommonBidgear::CPMSTAR_ADS => "CpmStart",
    CommonBidgear::BIDGEAR_RTB_ADS => "BidGear RTB",
    CommonBidgear::FIDELITY_ADS => "Fildelity",
    CommonBidgear::BIDGEAR_DSP_ADS => "Bidgear DSP",
];
?>

<?php
$this->registerJs(<<<JS
 jQuery(document).ready(function(){
    initUIImport();
 });
JS
    , \yii\web\View::POS_END);
?>
<script>
    function initUIImport() {
        $("#range_date").daterangepicker({
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
    }
</script>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bar-chart font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">Update by date</span>
                    <span class="caption-helper">...</span>
                </div>

                <div class="tools">
                </div>
                <div class="actions">
                </div>
            </div>
            <div class="portlet-body" id="place-report-update">
                <?php $form = ActiveForm::begin([
                    'id' => 'update-by-date-form',
                    'layout' => 'default',
                    'fieldConfig' => [
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-4',
                            'offset' => '',
                            'wrapper' => 'col-sm-8',
                            'error' => '',
                            'hint' => '',
                        ],
                    ]
                ]); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'date', [])->textInput(['rows' => 5, 'class' => 'form-control', 'id' => "range_date"]); ?>
                        <?php $url0 = "http://report.bidgear-syndication.com/user/cron/remote-ads-campaign";?>
                        <?php $url = "http://report.bidgear-syndication.com/user/cron/update-by-date?date=".$date."&partner=".$partner;?>
                        <?php $url2 = "https://bidgear.com/user/cron/update-by-date?date=".$date;?>
                        <div>
                            <?php echo Html::a($url0,$url0,['target'=>"_blank"]);?>
                        </div>
                        <br/>
                        <div>
                        <?php echo Html::a($url,$url,['target'=>"_blank"]);?>
                        </div>
                        <br/>
                        <div>
                        <?php echo Html::a($url2,$url2,['target'=>"_blank"]);?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'partner', [])->checkboxList($partnerList, []); ?>
                    </div>
                </div>


                <div class="form-submit">
                    <?php
                    echo Html::submitButton("<i class='fa fa-save'></i> Get",
                        ['class' => 'btn btn-primary']);
                    ?>
                    <a href="<?php echo \yii\helpers\Url::toRoute('index'); ?>"
                       class="btn btn-default"><?php echo 'Cancel'; ?></a>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>









