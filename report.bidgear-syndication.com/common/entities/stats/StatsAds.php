<?php

namespace common\entities\stats;

use common\models\base\AbstractObject;

/**
 * This is the model class for table "stats_ads".
 *
 * @property integer $id
 *
 * @property integer $source_id
 * @property integer $ads_id
 * @property string $ads_campaign_id
 * @property integer $bg_campaign_id
 * @property integer $total_imps
 * @property integer $paid_imps
 * @property integer $rev
 * @property integer $date
 */
class StatsAds extends AbstractObject
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stats_ads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bg_campaign_id', 'date', 'ads_id', 'ads_campaign_id', 'source_id'], 'required'],
            [['bg_campaign_id', 'total_imps', 'paid_imps', 'ads_id'], 'integer'],
            [['date', 'rev'], 'safe'],
            [['ads_campaign_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',

            "source_id" => "Source ID",
            'ads_id' => "Advertiser ID",
            'ads_campaign_id' => 'Advertiser Tag ID',
            'bg_campaign_id' => 'Bg Tag ID',
            'total_imps' => 'Total Imps',
            'paid_imps' => 'Paid Imps',
            'rev' => 'Revenue',
            'date' => 'Date',
        ];
    }
}
