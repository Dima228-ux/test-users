<?php



use common\models\Role;
use common\models\RoleUsers;
use common\models\User;
use common\models\UserForm;
use yii\db\Query;
use yii\web\HttpException;

class UserService
{
   public function getUser(int $id)
   {

       if ($user_model = User::findOne($id)) {
          return throw new HttpException(404);
       }

       $user = new UserForm($user_model);
       $user->roles = (new Query())
           ->select(['id','name'])
           ->from(Role::tableName())
           ->join('JOIN',['c'=>RoleUsers::tableName()],
                  'c.role_id=roles.id')
           ->where(['c.user_id' => $id])
           ->column();

       return $user;
   }
}