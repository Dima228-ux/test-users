<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Class RegistedUserForm
 * @package common\models
 */
class RegistedUserForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            ['email', 'email'],
            ['username', 'string', 'length' => [3, 8]],
            ['password', 'string', 'length' => [3, 8]],
            [
                'username',
                'unique',
                'targetAttribute' => 'username',
                'targetClass' => User::class,
                'message' => '{attribute} username is already exists'
            ],
            ['email', 'unique', 'targetAttribute' => 'email', 'targetClass' => User::class],

        ];
    }

    /**
     * @return bool
     */
    public function registedUser()
    {
        if (!$this->validate() && Yii::$app->user) {
            return false;
        }

        $user = User::registedNewUser($this->username, $this->password, $this->email);
        if (!$user) {
            return false;
        }

        return true;
    }
}