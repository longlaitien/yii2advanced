<?php
namespace backend\modules\system\forms\user;

use common\entities\system\RecordLog;
use common\entities\user\Admins;
use common\entities\user\UserIdentity;
use common\forms\log\LogForm;
use common\forms\system\RecordLogForm;

/**
 * Class AdminForm
 * @package backend\modules\system\forms\user
 */
class AdminForm extends UserIdentity
{
    public function toSave()
    {
        $isNew = $this->isNewRecord;
        $trans = $this->getDb()->beginTransaction();
        if ($isNew) { //TODO set password
            $password = 'bidgear@428';
            $this->password = $password;
        }
        //TODO save user info
        $this->save();

        if (!$this->hasErrors()) {
            $trans->commit();
            if ($isNew) {//TODO send email to user
                
            }
            return true;
        } else {
            $trans->rollBack();
        }
        return false;
    }

    public static function dataStatus()
    {
        return [
            static::STATUS_ACTIVE => 'Active',
            static::STATUS_INACTIVE => 'In-Active'
        ];
    }

    public static function dataRole()
    {
        return [
            Admins::ROLE_BUSINESS => 'Business',
            Admins::ROLE_ADMIN => 'Admin',
        ];
    }

    public function afterSave($insert, $attributes)
    {
        parent::afterSave($insert, $attributes);
        if ($insert) {
            //TODO log new domain
            $email = '';
            if (!\Yii::$app->user->isGuest) {
                $email = \Yii::$app->user->identity->email;
            }
            $message = "Admin($email) have created new admin ($this->email)";
            RecordLogForm::addCreateRecordLog(RecordLog::SETTING_OBJECT, $this->user_id, $message, RecordLog::CATEGORY_BACKEND);
        } else {
            if (count($attributes) > 0) {
                $email = '';
                if (!\Yii::$app->user->isGuest) {
                    $email = \Yii::$app->user->identity->email;
                }
                $message = "Admin($email) have updated admin ($this->email)";
                $from_value = [];
                $to_value = [];
                foreach ($attributes as $attribute => $value) {
                    if($attribute != 'password'){
                        $from_value[$attribute] = $value;
                        $to_value[$attribute] = $this->$attribute;
                    }
                }
                LogForm::addUpdateRecordLog(RecordLog::CAMPAIGN_OBJECT, $this->user_id, $message, $from_value, $to_value, RecordLog::CATEGORY_BACKEND);
            }
        }
    }
}