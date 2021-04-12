<?php
namespace common\forms\log;


use common\entities\system\RecordLog;
use yii\helpers\Json;

/**
 * Class LogForm
 * @package common\forms\log
 */
class LogForm extends RecordLog
{
    //TODO save
    public function toSave($runValidate = false){
        $this->created_time = static::convertTimeAmericaToVietNam(time());
        //TODO: not good code
        if($this->save($runValidate)){
            return true;
        }else{
            return false;
        }
    }
    //TODO add log
    public static function addRecordLog($object_type,$object_id, $type, $message, $from_value=[],$to_value=[], $category = LogForm::CATEGORY_SYSTEM){
        $log = new LogForm();
        $log->category = $category;
        $log->object_type = $object_type;
        $log->object_id = $object_id;
        $log->type = $type;
        $log->from_value = Json::encode($from_value);
        $log->to_value = Json::encode($to_value);
        $log->message = $message;
        if(!\Yii::$app->user->isGuest){
            $log->uid = \Yii::$app->user->identity->id;
        }
        if($log->toSave(false)){
            return true;
        }else{
            return false;
        }
    }

    //TODO add create log
    public static function addCreateRecordLog($object_type,$record_id, $message, $category){
        $type = LogForm::TYPE_CREATE;
        return self::addRecordLog($object_type,$record_id, $type, $message, [],[], $category);
    }

    //TODO add create log
    public static function addUpdateRecordLog($object_type,$record_id, $message,$from_value,$to_value, $category){
        $type = LogForm::TYPE_UPDATE;
        return self::addRecordLog($object_type,$record_id, $type, $message,$from_value,$to_value, $category);
    }

    //TODO add create log
    public static function addDeleteRecordLog($object_type,$record_id, $message, $category){
        $type = LogForm::TYPE_DELETE;
        return self::addRecordLog($object_type,$record_id, $type, $message,[],[], $category);
    }

    /**
     * @param $time America/New_York
     * @return timezone Asia/Ho_Chi_Minh
     */
    public static function convertTimeAmericaToVietNam($time){
        $difference = 3600*11;
        return $time+ $difference;
    }
}