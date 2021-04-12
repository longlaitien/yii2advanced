<?php

namespace common\entities\system;

use common\models\base\AbstractObject;

/**
 * This is the model class for table "record_log".
 *
 * @property integer $log_id
 * 
 * @property integer $uid
 * @property string $category
 * @property string $type
 * @property string $object_type
 * @property integer $object_id
 * @property string $message
 * @property string $from_value
 * @property string $to_value
 * @property integer $created_time
 */
class RecordLog extends AbstractObject
{
    const
        TYPE_CREATE = 'CREATE',
        TYPE_UPDATE = 'UPDATE',
        TYPE_DELETE = 'DELETE';

    const
        CATEGORY_FRONTEND = 'FRONTEND',
        CATEGORY_BACKEND = 'BACKEND',
        CATEGORY_SYSTEM = 'SYSTEM';

    const
        LOGIN_OBJECT = 'LOGIN',
        USER_OBJECT = 'USER',
        STATISTIC_OBJECT = 'STATISTIC',
        DOMAIN_OBJECT = "DOMAIN",
        CAMPAIGN_OBJECT = "CAMPAIGN",
        TAG_OBJECT = "TAG",
        LINE_OBJECT = "LINE",
        ADVERTISER_CAMPAIGN_OBJECT = "ADVERTISER_CAMPAIGN",
        CATEGORY_OBJECT = "CATEGORY",
        PAYMENT_OBJECT = "PAYMENT",
        CONTACTED_PUBLISHER_OBJECT = "CONTACTED_PUBLISHER",
        CONTACTED_STATUS_OBJECT = "CONTACTED_STATUS",
        CONTACT_OBJECT = "CONTACT",
        SETTING_OBJECT = 'SETTING',
        BFP_OBJECT = "BFP";
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'record_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'object_id', 'created_time'], 'integer'],
            [['type'],'string','max'=>15],
            [['category'],'string','max'=>63],
            [['from_value', 'to_value'], 'string'],
            [['object_type'], 'string', 'max' => 31],
            [['message'], 'string', 'max' => 1023],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'log_id' => 'Log ID',
            'uid' => 'Uid',
            'category'=>'Category',
            'type' => 'Type',
            'object_type' => 'Object Type',
            'object_id' => 'Object ID',
            'message' => 'Message',
            'from_value' => 'From Value',
            'to_value' => 'To Value',
            'created_time' => 'Created Time',
        ];
    }
}
