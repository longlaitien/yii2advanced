<?php
namespace backend\models;


use yii\base\Widget;

/**
 * Class BackendWidget
 * @package backend\models
 */
class BackendWidget extends Widget
{
    const
        TODAY_DAY = "TODAY_DAY",
        YESTERDAY_DAY = "YESTERDAY",
        THIS_WEEK_DAY = "THIS_WEEK_DAY",
        THIS_MONTH_DAY = "THIS_MONTH_DAY",
        LAST_MONTH_DAY = "LAST_MONTH_DAY",
        THIS_YEAR_DAY = 'THIS_YEAR_DAY',
        LIFETIME_DAY = 'LIFETIME_DAY',
        LAST_SEVEN_DAY = 'LAST_SEVEN_DAY';

    public function toCreateDate($type){
        switch ($type){
            case self::YESTERDAY_DAY;
                $from = date('Y-m-d', strtotime("-1 days"));
                $to = $from;
                $label = 'Yesterday';
                break;
            case self::LAST_SEVEN_DAY;
                $from = date('Y-m-d', strtotime("-6 days"));
                $to = date('Y-m-d');
                $label = 'Last 7 days';
                break;
            case self::THIS_WEEK_DAY;
                $from = date('Y-m-d', strtotime('monday this week'));
                $to = date('Y-m-d');
                $label = 'This week';
                break;
            case self::THIS_MONTH_DAY;
                $from = date('Y-m-01');
                $to = date('Y-m-d');
                $label = 'This month';
                break;
            case self::LAST_MONTH_DAY;
                $from = date('Y-m-01', strtotime("-1 months"));
                $date_tmp = date('Y-m-01');
                $to = date('Y-m-d', strtotime("-1 day", strtotime($date_tmp)));
                $label = 'Last month';
                break;
            case self::THIS_YEAR_DAY;
                $from = date('Y-01-01');
                $to = date('Y-m-d');
                $label = 'This year';
                break;
            case self::LIFETIME_DAY;
                $from = date('2016-01-01');
                $to = date('Y-m-d');
                $label = 'Lifetime';
                break;
            default:
                $from = date('Y-m-d');
                $to = $from;
                $label = 'Today';
        }
        return [
            'from'=>$from,
            'to'=>$to,
            'label'=>$label,
        ];
    }
}