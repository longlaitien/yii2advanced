<?php
namespace backend\forms;

use backend\models\BackendForm;
use backend\modules\system\forms\user\AdminForm;
use common\entities\user\UserIdentity;


/**
 * Class ChangePasswordForm
 * @package backend\modules\system\models
 *
 * @property string $new_password
 * @property string $new_password_again
 *
 * @property UserIdentity $_user
 */
class ChangePasswordRequiredForm extends BackendForm
{
    public $new_password, $new_password_again;

    public function rules()
    {
        return [
            [['new_password', 'new_password_again'], 'required'],
            [['new_password', 'new_password_again'], 'string', 'min' => 8, 'max' => 15],
            [['new_password', 'new_password_again'], 'safe'],
            ['new_password', 'validateNewPassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
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

        if (!empty($this->new_password) && $this->new_password != null) {
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}$/', $this->new_password)) {
                $this->addError($attribute, 'Password must have 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character and length min is 8, length max is 15');
            }
        }
    }

    public function toChangePassword()
    {
        if ($this->validate()) {
            /**
             * @var $user UserIdentity
             */
            $user = AdminForm::findOne(\Yii::$app->user->getId());
            $user->setPassword($this->new_password);
            $user->change_pass_time = time();
            if ($user->save()) {
                return true;
            } else {
                $this->addErrors($user->getErrors());
            }
        }
        return false;
    }
}