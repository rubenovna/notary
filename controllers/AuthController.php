<?php
/**
 * Created by PhpStorm.
 * User: lilia
 * Date: 05.08.19
 * Time: 12:39
 */

namespace app\controllers;


use app\models\Users;


use yii;


class AuthController extends AppController
{
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
        return $this->render('login', [
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

       // return $this->goHome();
    }

    public function actionTest(){
        $user = Users :: findOne(1);

    Yii::$app->user->login($user);


    if(Yii::$app->user->isGuest){
        echo "пользователь гость";
    } else{
        echo 'пользователь ';
    }
    }
}