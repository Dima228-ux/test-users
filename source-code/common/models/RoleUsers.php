<?php


namespace common\models;


use yii\db\ActiveRecord;

/**
 * Class RoleUsers
 * @package common\models
 */
class RoleUsers extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'role_users';
    }
}