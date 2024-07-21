<?php


namespace common\models;


use Yii;


/**
 * Class UserForm
 * @package common\models
 */
class UserForm extends Model
{
    public $username;
    public $email;
    public $type;
    public $roles;
    public $password;

    /**
     * UserForm constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->setAttributes($this->_entity->getAttributes(), false);
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['username', 'email', 'type', 'roles'], 'required'],
            [
                'password',
                'required',
                'when' => function () {
                    return $this->isNewRecord;
                }
            ],
            ['email', 'email'],
            ['username', 'string', 'length' => [3, 8]],
            [
                'password',
                'string',
                'length' => [3, 20],
                'when' => function () {
                    return $this->isNewRecord;
                }
            ],
            ['type', 'integer'],
            [
                ['username'],
                'unique',
                'targetAttribute' => 'username',
                'targetClass' => User::class,
                'message' => 'This {attribute} is already exists',
                'when' => function ($model) {
                    $count = User::find()->where(['username' => $model->username])->count();

                    if ($count > 1 && !$this->isNewRecord) {
                        return true;
                    } elseif (User::find()->where(['username' => $model->username])->exists() && $this->isNewRecord) {
                        return true;
                    }
                    return false;
                }
            ],
            [
                ['email'],
                'unique',
                'targetAttribute' => 'email',
                'targetClass' => User::class,
                'message' => 'This {attribute} is already exists',
                'when' => function ($model) {
                    $count = User::find()->where(['email' => $model->email])->count();

                    if ($count > 1 && !$this->isNewRecord) {
                        return true;
                    } elseif (User::find()->where(['email' => $model->email])->exists() && $this->isNewRecord) {
                        return true;
                    }
                    return false;
                }
            ],
        ];
    }

    /**
     * @return false|int
     * @throws \yii\base\Exception
     * @throws \yii\db\Exception
     */
    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $accessToken = mb_substr(str_shuffle(MD5(time() . microtime())), 0, 16, 'UTF-8');
        $authKey = Yii::$app->security->generateRandomString(5);

        /** @var User $user */
        $user = $this->_entity;

        if ($this->isNewRecord || strlen(trim($this->password)) > 2) {
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
        }

        $user->username = $this->username;
        $user->email = $this->email;
        $user->type = $this->type;
        $user->accessToken = $accessToken;
        $user->authKey = $authKey;

        if ($user->save()) {
            return $this->insertRoles($user->id, $this->roles);
        }
    }

    /**
     * @param int $id
     * @param array $rules
     * @return int
     * @throws \yii\db\Exception
     */
    private function insertRoles(int $id, array $rules)
    {
        $insert = [];
        foreach ($rules as $rule) {
            $insert[] = [$id, $rule];
        }

        RoleUsers::deleteAll(['user_id' => $id]);
        return Yii::$app->db->createCommand()->batchInsert(
            RoleUsers::tableName(),
            ['user_id', 'role_id'],
            $insert
        )->execute();
    }

}