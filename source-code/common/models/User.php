<?php

namespace common\models;


use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 *
 * @property string $USER [char(32)]
 * @property int $CURRENT_CONNECTIONS [bigint(20)]
 * @property int $TOTAL_CONNECTIONS [bigint(20)]
 * @property int $id [int(11)]
 * @property string $username [varchar(30)]
 * @property string $email [varchar(30)]
 * @property string $password [varchar(30)]
 * @property string $type [int(11)]
 * @property string $authKey
 * @property string $accessToken [varchar(50)]
 */
class User extends ActiveRecord implements IdentityInterface
{
    public const TYPE_ENGINEER = 1;
    public const  TYPE_ADMIN = 2;

    public static function tableName()
    {
        return 'users';
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['accessToken' => $token]);
    }

    /**
     * @param $username
     * @return array|ActiveRecord|null
     */
    public static function findByUsername($username)
    {
        return self::find()->where(['username' => $username])->one();
    }

    public static function getUserId($userName)
    {
        $user = self::find()->select('id')->where(['username' => $userName])->one();
        if ($user) {
            return $user->id;
        }

        return 'false';
    }

    /**
     * @return array|string[]
     */
    public static function getTypeUsers(): array
    {
        return [
            self::TYPE_ENGINEER => 'Engineer',
            self::TYPE_ADMIN => 'Admin',
        ];
    }

    public static function getTypeUser(int $type)
    {
        $list = [
            self::TYPE_ENGINEER => 'Engineer',
            self::TYPE_ADMIN => 'Admin',
        ];

        return $list[$type];
    }

    /**
     * @param $type
     * @return int
     */
    public  function getNumberType($type ){

        if(strpos('admin',$type) !== false){
            return self::TYPE_ADMIN;
        }else if(strpos('engineer',$type) !== false){
            return self::TYPE_ENGINEER;
        }
    }

    /**
     * @param $userName
     * @param $password
     * @param $email
     * @return User|false
     * @throws Exception
     */
    public static function registedNewUser($userName, $password, $email)
    {
        $accessToken = mb_substr(str_shuffle(MD5(time() . microtime())), 0, 16, 'UTF-8');
        $password = Yii::$app->security->generatePasswordHash($password);
        $authKey = Yii::$app->security->generateRandomString(5);

        $user = new User();

        $user->username = $userName;
        $user->email = $email;
        $user->password = $password;
        $user->accessToken = $accessToken;
        $user->authKey = $authKey;

        if ($user->save()) {
            return $user;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
