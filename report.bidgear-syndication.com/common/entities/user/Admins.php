<?php

namespace common\entities\user;

use common\models\base\AbstractObject;
use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property string $user_id
 *
 * @property string $avatar
 *
 * @property string $full_name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $mobile
 * @property string $address
 * @property string $birthday
 *
 * @property string $status
 * @property integer $change_pass_time
 * @property string $role
 *
 * @property integer $created_at
 * @property string $created_by
 * @property integer $modified_at
 * @property string $modified_by
 *
 */
class Admins extends AbstractObject
{
    const
        USER_SYSTEM= 'USER_SYSTEM';

    const
        STATUS_PENDING = "PENDING";

    const
        ROLE_BUSINESS = "BUSINESS",
        ROLE_ADMIN = "ADMIN";

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admins';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name', 'username', 'password', 'email'], 'required'],
            [['username', 'email'], 'unique'],
            [
                ["birthday",], "date", "format" => "yyyy-m-d"
            ],
            [['birthday'], 'safe'],
            [['username'], 'unique'],
            [['password'], 'string', 'max' => 250],
            [['address'], 'string', 'max' => 250],
            [['mobile'], 'string', 'max' => 100],
            [['avatar', 'username', 'email'], 'string', 'max' => 100],
            [['role'], 'string', 'max' => 20],
            [['user_id','status','created_by','modified_by', 'created_at', 'modified_at','change_pass_time'],'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' =>  'User',

            'full_name' => 'Full name',
            'avatar' => 'Avatar',
            'username' => 'Username',
            'password' =>  'Password',
            'email' =>  'Email',
            'mobile' =>  'Mobile',
            'address' => 'Address',
            'birthday' =>  'Birthday',

            'role' =>  'Role',

            'status' =>  'Status',
            'change_pass_time'=>'Change Pass Time',
            'created_at' => 'Created At',
            'created_by' =>  'Created By',
            'modified_at' => 'Modified At',
            'modified_by' => 'Modified By',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->user_id = $this->genId();

                $this->created_at = time();
                $this->created_by = $this->currentUserId;
                if (is_null($this->created_by)) {
                    $this->created_by = $this->user_id;
                }
                if (is_null($this->status)) {
                    $this->status = static::STATUS_ACTIVE;
                }
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
            }
            $this->modified_at = time();
            $this->modified_by = $this->currentUserId;
            return true;
        }
        return false;
    }

}
