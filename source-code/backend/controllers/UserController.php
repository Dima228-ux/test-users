<?php


namespace backend\controllers;


use common\models\User;
use common\models\UserForm;
use common\models\UsersSearch;
use common\services\userService\UserService;
use Exception;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Class UserController
 * @package backend\controllers
 */
class UserController extends BasicController
{

    /**
     * @return string|Response
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $searchModel = new UsersSearch();
        $provider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['provider' => $provider, 'searchModel' => $searchModel]);
    }

    /**
     * @return string|Response
     * @throws Exception
     */
    public function actionAdd()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->view->title = 'Add new User';
        $user = new UserForm(new User());

        if ($this->isPost()) {
            $userService = new UserService();
            if (!$user = $userService->save($this->post(), $user)) {
                $user = new UserForm(new User());
                $this->setFlash('error', 'User  error added');
            } else {
                $this->setFlash('success', 'User ' . Html::encode($user->username) . ' successfully added');
                return $this->redirect(Url::toRoute(['user/update', 'id' => $user->_entity->id]));
            }
        }

        return $this->render(
            'form',
            [
                'user' => $user,
            ]
        );
    }

    /**
     * @return string|Response
     * @throws HttpException
     */
    public function actionView()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->view->title = 'Profile User';
        $id = $this->getInt('id');

        if (!$id) {
            throw new HttpException(404);
        }

        $userService = new UserService();
        if (!$user = $userService->getUser($id)) {
            throw new HttpException(404);
        }

        return $this->render(
            'preview',
            [
                'user' => $user,
            ]
        );
    }

    /**
     * @return string|Response
     * @throws HttpException
     */
    public function actionUpdate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (Yii::$app->user->identity->type != User::TYPE_ADMIN) {
            $this->redirect(Url::toRoute(['/']));
        }

        $this->getView()->title = 'Edit user';

        $id = $this->getInt('id');

        if (!$id) {
            throw new HttpException(404);
        }

        $userService = new UserService();
        if (!$user = $userService->getUser($id)) {
            throw new HttpException(404);
        }

        if ($this->isPost()) {
            if (!$user = $userService->save($this->post(), $user)) {
                $this->setFlash('error', 'User ' . Html::encode($user->username) . ' error edited');
            } else {
                $this->setFlash('success', 'User ' . Html::encode($user->username) . ' successfully edited');
            }
            return $this->redirect(Url::toRoute(['user/update', 'id' => $user->_entity->id]));
        }

        return $this->render(
            'form',
            [
                'user' => $user,
            ]
        );
    }
}