<?php
namespace common\models\base;

use common\entities\user\UserIdentity;
use Yii;
use yii\base\Model;

/**
 * Class AbstractLoginForm
 * @package common\models\base
 *
 * @property string $username
 * @property string $password
 * @property bool $rememberMe
 */
abstract class AbstractLoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    /**
     * @var UserIdentity
     */
    protected $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
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
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute,  'Incorrect username or password.');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            "username" =>  "Username",
            "password" =>  "Password",
            "rememberMe" =>  "remember",
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            if (Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0)) {
                $this->afterLogin();
                return true;
            }
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return UserIdentity|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = UserIdentity::findByUsername($this->username);
        }
        return $this->_user;
    }

    protected function afterLogin()
    {

    }
}
