<?php
namespace backend\modules\system\forms\log;

use common\entities\system\RecordLog;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Class RecordLogSearchForm
 * @package backend\modules\system\forms\log
 *
 * @property integer $publisher_id
 * @property string $start_date
 * @property string $end_date
 * @property string $date_search
 */
class RecordLogSearchForm extends RecordLog
{
    public $publisher_id;
    public $start_date;
    public $end_date;
    public $date_search;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['publisher_id', 'start_date', 'end_date', 'date_search'], 'safe'],
        ]);
    }

    public static function dataCategory()
    {
        return [
            '-1' => "All",
            self::CATEGORY_FRONTEND => "Frontend",
            self::CATEGORY_BACKEND => "Backend",
        ];
    }

    //TODO: search
    public function search()
    {
        $query = parent::find();

        if (!empty($this->date_search) && $this->date_search != null) {
            $date = explode(" to ", $this->date_search);
            if (is_array($date)) {
                $this->start_date = $date[0];
                if (isset($date[1])) {
                    $this->end_date = $date[1];
                }

                if (!empty($this->start_date)) {
                    $this->start_date = strtotime($this->start_date);
                }

                if (!empty($this->end_date)) {
                    $this->end_date = strtotime($this->end_date);
                }

                if ($this->start_date != null && !empty($this->start_date)) {
                    $query->andWhere('created_time >= :start_date', [
                        ':start_date' => $this->start_date,
                    ]);
                }

                if ($this->end_date != null && !empty($this->end_date)) {
                    $this->end_date = $this->end_date + 86400 - 1;
                    $query->andWhere('created_time <= :end_date', [
                        ':end_date' => $this->end_date,
                    ]);
                }
            }
        }

        if ($this->category != null && !empty($this->category) && $this->category != -1) {
            $query->andWhere('category = :category', [
                'category' => $this->category,
            ]);
        }

        if ($this->publisher_id != null && !empty($this->publisher_id) && $this->publisher_id != -1) {
            $query->andWhere('uid = :uid', [
                'uid' => $this->publisher_id,
            ]);
            $query->andWhere('category = :pub_category', [
                ':pub_category' => self::CATEGORY_FRONTEND,
            ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 40],
        ]);
        $dataProvider->setSort([
            'defaultOrder' => ['log_id' => SORT_DESC],
            'attributes' => [
                'log_id',
                'category',
                'type',
                'message',
                'created_time',
            ]
        ]);
        return $dataProvider;
    }

    //TODO format message
    public function formatMessage()
    {
        switch ($this->object_type) {
            case RecordLog::STATISTIC_OBJECT:
                $label = "success";
                $icon = "bar-chart-o";
                $link = \Yii::$app->urlManager->createUrl([
                    "/user/manage/view",
                    'id' => $this->object_id,
                ]);
                break;
            case RecordLog::PAYMENT_OBJECT;
                $label = "success";
                $icon = "money";
                $link = \Yii::$app->urlManager->createUrl([
                    "/user/payment/index",
                ]);
                break;
            case RecordLog::DOMAIN_OBJECT;
                $label = "info";
                $icon = "table";
                $link = \Yii::$app->urlManager->createUrl([
                    "/user/domain/update",
                    'id' => $this->object_id,
                ]);
                break;
            case RecordLog::CAMPAIGN_OBJECT;
                $label = "warning";
                $icon = "rebel";
                $link = \Yii::$app->urlManager->createUrl([
                    "/user/campaign/index",
                    'camp_id' => $this->object_id,
                ]);
                break;
            case RecordLog::CONTACT_OBJECT;
                $label = "default";
                $icon = "music";
                $link = \Yii::$app->urlManager->createUrl([
                    "/user/contact/view",
                    'id' => $this->object_id,
                ]);
                break;
            case RecordLog::CONTACTED_PUBLISHER_OBJECT:
                $label = 'success';
                $icon = 'briefcase';
                $link = \Yii::$app->urlManager->createUrl([
                    "/user/contacted-publisher/update",
                    'id' => $this->object_id,
                ]);
                break;
            case RecordLog::CONTACTED_STATUS_OBJECT:
                $label = 'info';
                $icon = 'calendar';
                $link = "#";
                break;
            case RecordLog::CATEGORY_OBJECT:
                $label = 'info';
                $icon = 'bars';
                $link = \Yii::$app->urlManager->createUrl([
                    "/user/category/update",
                    'id' => $this->object_id,
                ]);
                break;
            case RecordLog::SETTING_OBJECT:
                $label = 'info';
                $icon = 'cog';
                $link = "#";
                break;
            default:
                $label = "danger";
                $icon = "user";
                $link = "#";
        }
        return [
            'label' => $label,
            'icon' => $icon,
            'link' => $link
        ];
    }

    public function formatMessageView()
    {
        $content = $this->formatMessage();
        $icon = $content['icon'];
        $label = $content['label'];
        $link = $content['link'];
        return "<label class='label label-sm label-$label' style='padding-top: 4px'><i class='fa fa-$icon'></i></label> " . Html::a(Html::encode($this->message), $link, [
            'target' => "_blank",
            'data-pjax' => 0
        ]);
    }

}