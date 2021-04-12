<?php
namespace backend\filters;

use common\entities\user\Admins;
use yii\filters\AccessRule;

/**
 * Class BackendAccessRule
 * @package backend\filters
 */
class BackendAccessRule extends AccessRule
{
    /**
     * @var Admins
     */
    private $_user;

    /**
     * @param \yii\web\User $user the user object
     * @return boolean whether the rule applies to the role
     */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === '@') {
                if (!$user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === Admins::ROLE_ADMIN) {
                if (!$user->getIsGuest()) {
                    $this->_user = \Yii::$app->user->identity;
                    if ($this->_user != null) {
                        if($this->_user->role == Admins::ROLE_ADMIN){
                            return true;
                        }
                    }
                }
            } elseif ($role === Admins::ROLE_BUSINESS) {
                if (!$user->getIsGuest()) {
                    $this->_user = \Yii::$app->user->identity;
                    if ($this->_user != null) {
                        if($this->_user->role == Admins::ROLE_ADMIN || $this->_user->role == Admins::ROLE_BUSINESS){
                            return true;
                        }
                    }
                }
            } elseif ($user->can($role)) {
                return true;
            }
        }
        return false;
    }
}