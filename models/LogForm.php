<?php
/**
 * Created by PhpStorm.
 * User: lilia
 * Date: 31.07.19
 * Time: 14:26
 */
namespace app\models;
use app\models\generated\Users;
use yii\base\Model;
use app\models\User;
use Yii;
class LogForm extends Model
{
    public $username;
    public $password;
    public $role;
    public $rememberMe = true;
    public $status;


    private $_user = false;

    public function attributeLabels()// спомощью этого метода меняем наименованией полей используем место labels в forme
    {
        return [

            'username' => 'Логин',
            'password' => 'Пароль',
            'role' => 'Выбрать',
            'rememberMe' => 'Запомнить меня'

        ];
    }

    public function rules()
    {
        return [
            [['username', 'password', 'role'], 'required'/*, 'on' => 'default'*/],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];

    }

    public function validatePassword($attribute)
    {
       if (!$this ->hasErrors()):
           $user = $this->getUser();
       if (!$user || !$user->validatePassword($this->password)):
           $this->addError($attribute, "неправильно имя пользователя или пароль. ");
       endif;
       endif;
    }


  /*  public function login()
    {
        if ($this->validate()):*/
           /* $this->status = ($user = $this->getUser()) ? $user->status : Users::STATUS_NOT_ACTIVE;
            if ($this->status === Users::STATUS_ACTIVE):*/
               /* return  Yii::$app->user->login($this->getUser, $this->rememberMe ? 3600*24*30 : 0);*/

            /*else:
                return false;
            endif;*/
       /* else:
            return false;
        endif;
    }*/


     public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Users::findByUsername($this->username);
        }

        return $this->_user;
    }


}