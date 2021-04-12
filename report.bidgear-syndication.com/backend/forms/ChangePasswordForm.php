<?php
namespace backend\forms;

use backend\models\BackendForm;
use common\entities\system\RecordLog;
use common\entities\user\Admins;
use common\entities\user\UserIdentity;
use common\forms\log\LogForm;


/**
 * Class ChangePasswordForm
 * @package backend\modules\system\models
 *
 * @property string $password
 * @property string $new_password
 * @property string $new_password_again
 *
 * @property UserIdentity $_user
 */
class ChangePasswordForm extends BackendForm
{
    public $password, $new_password, $new_password_again;

    private $_user;

    public function rules()
    {
        return [
            [['password', 'new_password', 'new_password_again'], 'required'],
            [['new_password', 'new_password_again'], 'string', 'min' => 8, 'max' => 15],
            [['password', 'new_password', 'new_password_again'], 'safe'],
            ['password', 'validatePassword'],
            ['new_password', 'validateNewPassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Current Password',
            'new_password' => 'New Password',
            'new_password_again' => 'Re-type New Password',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateNewPassword($attribute, $params)
    {
        if ($this->new_password != $this->new_password_again) {
            $this->addError($attribute, 'New password and re-new password is not much!');
        }

        if ($this->new_password == $this->password) {
            $this->addError($attribute, 'New password must be different old password');
        }

        //^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])[A-Za-z\d$@$!%*#?&]$
        if (!empty($this->new_password) && $this->new_password != null) {
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}$/', $this->new_password)) {
                $this->addError($attribute, 'Password must have 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character and length min is 8, length max is 15');
            }
        }
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $this->_user = $this->getUser();
            if (!$this->_user || !$this->_user->validatePassword($this->password)) {
                $this->addError($attribute, 'Your password is wrong.');
                if ($this->_user->status != Admins::STATUS_ACTIVE) {
                    $this->addError($attribute, 'You do not have permission.');
                }
            }
        }
    }

    /**
     * @return null|UserIdentity
     */
    private function getUser()
    {
        return UserIdentity::findOne(\Yii::$app->user->getId());
    }

    public function toChangePassword()
    {
        if ($this->validate()) {
            /**
             * @var $user UserIdentity
             */
            $user = $this->_user;
            $user->setPassword($this->new_password);
            if ($user->save()) {
                //TODO log change password
                $email = '';
                if (!\Yii::$app->user->isGuest) {
                    $email = \Yii::$app->user->identity->email;
                }
                $message = "Admin($email) have change password";
                LogForm::addCreateRecordLog(RecordLog::SETTING_OBJECT, \Yii::$app->user->getId(), $message, Log::CATEGORY_BACKEND);

                return true;
            } else {
                $this->addErrors($user->getErrors());
            }
        }
        return false;
    }
}