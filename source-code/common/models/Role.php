<?php


namespace common\models;


use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * Class Role
 * @package common\models
 */
class Role extends ActiveRecord
{
    /**
     * @return array
     */
    public static function getRoles()
    {
        $roles = (new Query())
            ->select(['name'])
            ->from(Role::tableName())
            ->indexBy('id')
            ->column();

        return $roles;
    }

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'roles';
    }
}