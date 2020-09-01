<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\User;
use yii\web\Controller;
use Yii;
use yii\web\Response;

class AuthController extends Controller
{
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('/site/login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionTest()
    {
        $user = User::findOne(1);

        Yii::$app->user->login($user);

        if (Yii::$app->user->isGuest){
            echo 'User is guest';
        } else {
            echo 'User logged in';
        }

    }
}