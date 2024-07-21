<?php

namespace common\services\userService;

use common\models\Role;
use common\models\RoleUsers;
use common\models\User;
use common\models\UserForm;
use yii\db\Query;

/**
 * Class UserService
 * @package common\services\userService
 */
class UserService
{
    /**
     * @param int $id
     * @return UserForm|false
     */
   public function getUser(int $id)
   {
       if (!$user_model = User::findOne($id)) {
          return false;
       }

       $user = new UserForm($user_model);
       $user->roles = (new Query())
           ->select(['roles.id','name'])
           ->from(Role::tableName())
           ->join('JOIN',['c'=>RoleUsers::tableName()],
                  'c.role_id=roles.id')
           ->where(['c.user_id' => $id])
           ->column();
       $user->password = '';
       return $user;
   }

    /**
     * @param array $post
     * @param UserForm $user
     * @return UserForm|false
     * @throws \yii\base\Exception
     * @throws \yii\db\Exception
     */
   public function save(array $post,UserForm $user)
   {
       $user->roles = $post['roles'];
       $user->type = $post['type'];

       if($user->load($post) && $user->save()){
           return $user;
       }

       return  false;
   }
}