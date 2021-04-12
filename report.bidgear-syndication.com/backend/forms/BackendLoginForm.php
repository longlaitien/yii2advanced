<?php
namespace backend\forms;


use common\entities\user\UserIdentity;
use common\models\base\AbstractLoginForm;

/**
 * Class BackendLoginForm
 * @package backend\forms
 *
 */
class BackendLoginForm extends AbstractLoginForm
{
    public function validatePassword($attribute, $params)
    {
        parent::validatePassword($attribute, $params);
        if (!$this->hasErrors()) {
            if ($this->_user->role != UserIdentity::ROLE_ADMIN && $this->_user->role != UserIdentity::ROLE_BUSINESS) {
                $this->addError("username", "You do not have permission.");
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            if (\Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0)) {
                $this->afterLogin();
                return true;
            }
        }
        return false;
    }

    protected function afterLogin()
    {

    }
}