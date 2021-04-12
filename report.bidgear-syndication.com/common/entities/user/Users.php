<?php

namespace common\entities\user;

use Yii;
use common\models\base\AbstractObject;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 *
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $city
 * @property string $cc_id
 * @property string $state
 * @property string $zip_code
 * @property integer $type
 * @property integer $forgot
 * @property integer $use_real_time
 * @property string $ip
 * @property string $browser
 * @property integer $assign_to
 * @property string $create
 * @property string $last_login
 *
 * @property integer $status
 *
 * @property Admins $manager
 */
class Users extends AbstractObject
{
    const
        STATUS_PENDING = 0,
        STATUS_ACTIVE = 1,
        STATUS_SUPPEND = 2,
        STATUS_REJECT = 3;

    const
        FORGOT_NO = 0,
        FORGOT_TRUE = 1;

    const
        TYPE_PUBLISHER = 1,
        TYPE_ADVERTISER = 2,
        TYPE_BOTH = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'first_name', 'last_name', 'cc_id'], 'required'],
            [['type', 'forgot', 'status','use_real_time'], 'integer'],
            [['create', 'last_login'], 'safe'],
            [['email', 'password', 'address'], 'string', 'max' => 128],
            [['first_name', 'last_name', 'city', 'state'], 'string', 'max' => 64],
            [['cc_id'], 'string', 'max' => 3],
            [['zip_code'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['last_login', 'type', 'forgot', 'create', 'status'], 'safe'],
            [['assign_to'],'integer'],
            [['id'],'safe'],
            [['ip'],'string','max'=>15],
            [['browser'],'string','max'=>512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'address' => 'Address',
            'city' => 'City',
            'cc_id' => 'Country',
            'state' => 'State',
            'zip_code' => 'Zip Code',
            'type' => 'Type',
            'ip'=>'Ip',
            'browser'=>'Browser',
            'forgot' => 'Forgot',
            'use_real_time'=>"Use Realtime Report",
            'assign_to'=>'Assign To',
            'create' => 'Create',
            'last_login' => 'Last Login',
            'status' => 'Status',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                if (is_null($this->status)) {
                    $this->status = static::STATUS_ACTIVE;
                }
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
                if (empty($this->last_login) && $this->last_login == null) {
                    $this->last_login = time();
                }
                if (empty($this->create) && $this->create == null) {
                    $this->create = time();
                }
                if (empty($this->forgot) && $this->forgot == null) {
                    $this->forgot = self::FORGOT_NO;
                }
                if (empty($this->type) && $this->type == null) {
                    $this->type = self::TYPE_PUBLISHER;
                }
                if (empty($this->status) && $this->status == null) {
                    $this->status = self::STATUS_PENDING;
                }
            }
            return true;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManager(){
        return $this->hasOne(Admins::className(),['user_id'=>'assign_to']);
    }
}
