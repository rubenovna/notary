<?php
/**
 * Created by PhpStorm.
 * User: lilia
 * Date: 31.07.19
 * Time: 13:48
 */
//namespace app\controllers\base;
//use app\controllers\AppController;
namespace app\controllers;

use app\models\AccountActivation;
use app\models\LogForm;
use app\models\RegForm;
use app\models\generated\Users;
use app\models\Profile;
use app\models\SendEmailForm;
use app\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii;
use yii\helpers\Html;
use yii\helpers\Url;


//use yii\web\Controller;
class RegController extends AppController
{

    public function actionRegister()
    {
        $emailActivation = Yii::$app->params['emailActivation'];




        $model = $emailActivation ? new RegForm(['scenario' => 'emailActivation']) : new RegForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = new Users();
            $user->username = $model->username;
            $user->email = $model->email;
            $user->status = $model->status;
            $user->role = $model->role;
            $user->setPassword($model->password);
            $user->generateAuthKey();
            if ($model->scenario=== 'emailActivation')
                $user->generateSecretKey();


            $user->save();
            if ($user->save()) {

                if ($user->status === Users::STATUS_ACTIVE) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                } else {
                    $session = Yii::$app->session;
                    $session['username'] = $user->username;
                    $session['secret_key'] = $user->secret_key;


                    Yii::$app->mailer->compose('activationEmail', ['user' => $user])
                        ->setFrom([\Yii::$app->params['supportEmail'] => Yii::$app->name . ' (отправлено роботом).'])
                        ->setTo($user->email)
                        ->setSubject('Активация для ' . Yii::$app->name)
                        ->send();

                    echo 'Письмо с активацией отправлено на емайл <strong>' . Html::encode($user->email) . '</strong> (проверьте папку спам).';

                }


            } else {
                Yii::$app->session->setFlash('error', 'Ошибка. Письмо не отправлено.');
                Yii::error('Ошибка отправки письма.');

            }
        } else {
            Yii::$app->session->setFlash('error', 'Возникла ошибка при регистрации.');
            Yii::error('Ошибка при регистрации');


        }


        return $this->render('register', compact('model'));
    }


    public function actionActivateAccount($key)
    {
        try {
            $user = new AccountActivation($key);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user->activateAccount()):
            Yii::$app->session->setFlash('success', 'Активация прошла успешно. <strong>' . Html::encode($user->username) . '</strong> вы теперь актив.');
        else:
            Yii::$app->session->setFlash('error', 'Ошибка активации.');
            Yii::error('Ошибка при активации.');
        endif;
        return $this->redirect(Url::to(['/reg/login']));
    }


    public function actionLogout()
    {

        Yii::$app->user->logout();
        return $this->redirect(['reg/login']);
    }


    public function actionLogin()

    {


        $model = new LogForm();


        if ($model->load(Yii::$app->request->post())) {
            $user = Users::find()->andWhere('username =:username', [':username' => $model->username])->one();

            $session = Yii::$app->session;

            $session['role'] = $user->role;
            $session['id'] = $user->id;


            Yii::$app->user->login($user, $model->rememberMe ? 3600 * 24 * 30 : 0);
            return $this->redirect(['/personal/area']);

        }

        return $this->render('login', compact('model'));
    }
}
