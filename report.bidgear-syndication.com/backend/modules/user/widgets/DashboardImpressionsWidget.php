<?php
namespace backend\modules\user\widgets;

use backend\models\BackendWidget;
use backend\modules\user\forms\stats\StatsAdsSearchForm;
use common\util\Common;

/**
 * Class DashboardImpressionsWidget
 * @package backend\modules\user\widgets
 * 
 * @property  $start_date string
 * @property $label string
 * @property $run_query integer
 * @property string $target
 * @property string $tag_id
 * @property string $source_id
 */
class DashboardImpressionsWidget extends BackendWidget
{
    public $start_date;
    public $run_query = 0;
    public $label ='Last 7 days';
    public $target= "_blank";
    public $tag_id;
    public $source_id;

    public function init()
    {
        $type = \Yii::$app->request->get('type', self::LAST_SEVEN_DAY);
        if(empty($this->tag_id)){
            $this->tag_id = \Yii::$app->request->get('tag_id', '');
        }
        $this->source_id = Common::getSource();
        if(empty($this->source_id)){
            $this->source_id = \Yii::$app->request->get('source_id', '');
        }

        if ($run_query = \Yii::$app->request->get('run_query')) {
            $this->run_query = $run_query;
        }

        $model = new StatsAdsSearchForm();
        $data = false;
        if ($this->run_query == 1) {

            $date = $this->toCreateDate($type);
            $model->start_date = $date['from'];
            $model->end_date = $date['to'];
            $model->bg_campaign_id = $this->tag_id;
            $model->source_id = $this->source_id;
            $this->label = $date['label'];

            $data = $model->toDataImpressionsDashboard();

        }

        echo $this->render("dashboard-impressions-widget",[
            'start_date'=>$this->start_date,
            'type'=>$type,
            'label'=>$this->label,
            'data'=>$data,
            'target'=>$this->target,
            'model'=>$model,
        ]);
    }
}