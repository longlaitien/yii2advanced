<?php

namespace backend\modules\user\forms\stats;

use common\entities\stats\StatsAds;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * Class StatsAdsSearchForm
 * @package frontend\modules\user\forms\stats
 *
 * @property string $date_search
 * @property string $start_date
 * @property string $end_date
 */
class StatsAdsSearchForm extends StatsAds
{

    public $date_search;
    public $start_date;
    public $end_date;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['start_date', 'end_date', 'date_search',], 'safe'],
        ]);
    }

    //TODO: search
    public function search()
    {
        $query = parent::find();

        if(!empty($this->ads_id) && $this->ads_id != null){
            $query->where('ads_id = :ads_id',[
                ':ads_id'=>$this->ads_id,
            ]);
        }

        if(!empty($this->ads_campaign_id) && $this->ads_campaign_id != null){
            $query->andWhere('ads_campaign_id = :ads_campaign_id',[
                ':ads_campaign_id'=>$this->ads_campaign_id,
            ]);
        }

        if(!empty($this->bg_campaign_id) && $this->bg_campaign_id != null){
            $query->andWhere('bg_campaign_id = :bg_campaign_id',[
                ':bg_campaign_id'=>$this->bg_campaign_id,
            ]);
        }

        if(!empty($this->date) && $this->date != null){
            $query->andWhere('date = :date',[
                ':date'=>$this->date,
            ]);
        }

        if (!empty($this->date_search) && $this->date_search != null) {
            $date = explode(" to ", $this->date_search);
            if (is_array($date)) {
                $this->start_date = $date[0];
                if (isset($date[1])) {
                    $this->end_date = $date[1];
                }

                if ($this->start_date != null && !empty($this->start_date)) {
                    $this->start_date = $this->start_date . " 00::00:00";
                    $query->andWhere('date >= :start_date', [
                        ':start_date' => $this->start_date,
                    ]);
                }

                if ($this->end_date != null && !empty($this->end_date)) {
                    $this->end_date = $this->end_date . " 23::59:59";
                    $query->andWhere('date <= :end_date', [
                        ':end_date' => $this->end_date,
                    ]);
                }
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 100],
        ]);
        
        $dataProvider->setSort([
            'defaultOrder' => ['id' => SORT_DESC],
            'attributes' => [
                'id',
                'ads_id',
                'ads_campaign_id',
                'bg_campaign_id',
                'total_imps',
                'paid_imps',
                'rev',
                'date',
            ]
        ]);
        return $dataProvider;
    }

    //TODO get data for dashboard
    public function toDataImpressionsDashboard()
    {
        $stats_table = StatsAdsSearchForm::tableName();

        $query = new Query();
        $query->select("SUM(" . $stats_table . ".total_imps) AS impress, " . $stats_table . ".date AS date");
        $query->from($stats_table);
        $query->groupBy($stats_table . ".date");

        if (!empty($this->start_date) && $this->start_date != null) {
            $query->andWhere($stats_table . '.date >= :start_date', [
                ':start_date' => $this->start_date . " 00:00:00",
            ]);
        }
        if (!empty($this->end_date) && $this->end_date != null) {
            $query->andWhere($stats_table . '.date <= :end_date', [
                ':end_date' => $this->end_date . " 23:59:59",
            ]);
        }
        $data = $query->all();
        return $data;
    }

}
