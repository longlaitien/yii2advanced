<?php
namespace common\forms\system;


use common\entities\system\RecordLog;
use yii\helpers\Json;

/**
 * Class RecordLogForm
 * @package common\forms\system
 */
class RecordLogForm extends RecordLog
{
    //TODO save
    public function toSave(){
        $this->created_time = static::convertTimeAmericaToVietNam(time());
        //TODO: not good code
        if($this->save($this->run_validate)){
            return true;
        }else{
            return false;
        }
    }
    //TODO add log
    public static function addRecordLog($object_type,$object_id, $type, $message, $from_value=[],$to_value=[], $category = RecordLog::CATEGORY_SYSTEM){
        $log = new RecordLogForm();
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
        $log->run_validate = false;
        if($log->toSave()){
            return true;
        }else{
            return false;
        }
    }

    //TODO add create log
    public static function addCreateRecordLog($object_type,$record_id, $message, $category){
        $type = RecordLog::TYPE_CREATE;
        return self::addRecordLog($object_type,$record_id, $type, $message, [],[], $category);
    }

    //TODO add create log
    public static function addUpdateRecordLog($object_type,$record_id, $message,$from_value,$to_value, $category){
        $type = RecordLog::TYPE_UPDATE;
        return self::addRecordLog($object_type,$record_id, $type, $message,$from_value,$to_value, $category);
    }

    //TODO add create log
    public static function addDeleteRecordLog($object_type,$record_id, $message, $category){
        $type = RecordLog::TYPE_DELETE;
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