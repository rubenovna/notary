<?php
/**
 * Created by PhpStorm.
 * User: lilia
 * Date: 31.07.19
 * Time: 13:42
 */

namespace app\models;

use app\models\generated\Users;

use yii\base\Model;
use Yii;

class RegForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $status;
    public $role;
    public $secret_key;

    public function attributeLabels()// спомощью этого метода меняем наименованией полей используем место labels в forme
    {
        return [
            'username'=>'Ваше логин',
            'email'=>'Ваш E-mail',
            'password'=>'Ваш пароль',
            'role'=>'Выбрать',
        ];
    }
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'trim'],
            [['username', 'email', 'password', 'role'],'required'],
            ['username', 'string', 'min' => 2, 'max' => 25],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['username', 'unique',
                'targetClass' => Users::className(),
                'message' => 'Это имя уже занято.'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => Users::className(),
                'message' => 'Эта почта уже занята.'],
            ['status', 'default',
                'value' => Users::STATUS_NOT_ACTIVE, 'on' => 'emailActivation'],
            //
            ['status', 'default', 'value' => Users::STATUS_ACTIVE, 'on' => 'default'],
            ['status', 'in', 'range' =>[
                Users::STATUS_NOT_ACTIVE,
                Users::STATUS_ACTIVE
            ]],







        ];

}

 /*public function reg()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->role = $this->role;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if($this->scenario === 'emailActivation')
            $user->generateSecretKey();
        return $user->save() ? $user : null;
    }*/



/*public function sendActivationEmail($user)
    {
        return Yii::$app->mailer->compose('activationEmail', ['user' => $user])
            ->setFrom([\Yii::$app->params['supportEmail'] => Yii::$app->name.' (отправлено роботом).'])
            ->setTo($this->email)
            ->setSubject('Активация для '.Yii::$app->name)
            ->send();*/



        /*if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($this->email)
                ->setFrom(['lilia.abaghyan@gmail.com' => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
        }*/




}