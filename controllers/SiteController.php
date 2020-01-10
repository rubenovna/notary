<?php

namespace app\controllers;


use app\models\SignupForm;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionSignup(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new SignupForm();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $user = new User();
            $user->username = $model->username;
            $user->email = $model->email;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);
            $user->auth_key = \Yii::$app->security->generateRandomString();
            $user->save();

            if($user->save()){
                return $this->goHome();
            }
        }

        return $this->render('signup', compact('model'));
    }








        //$model = new SignupForm();

        /*if ($model->load(Yii::$app->request->post())/* && $model->validate()*//*):*/
        /* if ($user = $model->signup()):
             if ($user->status === User::STATUS_ACTIVE):
                 if (Yii::$app->getUser()->login($user)):
                     return $this->goHome();
                 endif;
                 endif;
                 else:
                 Yii::$app->session->setFlash('error', 'Возникла ошибка при регистрации.');
             Yii::error('Ошибка при регистрации');
             return $this->refresh();
         endif;
     endif;*/









/*
       if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {


                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model
        ]);
    }*/






    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

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

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }








    /*public function actionAddAdmin() {


        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@кодер.укр';
        $user->status = 'STATUS_ACTIVE';
       $user ->created_at = "02032019";
        $user->setPassword('qwerty');
       // $user->generateAuthKey();
        $user->save();

        if ($user->save()) {

            $model = User::find()->where(['username' => 'admin'])->one();
            echo 'good';
        }*/



}
