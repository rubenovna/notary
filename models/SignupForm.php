<?php
namespace app\models;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такое логин уже занят.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такая почта уже занята.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
   /* public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
         echo '<pre>'; print_r($user); die;

        return $user->save() ? $user : null;
    }*/
}























/*
namespace app\models;
use yii\base\Model;*/

/**
 * Signup form
 */
/*class SignupForm extends Model
{
   const STATUS_ACTIVE = 10;
    const STATUS_NOT_ACTIVE = 20;
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
   /* public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['status', 'required'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['status', 'default', 'value' =>[ self::STATUS_ACTIVE, 'on' => 'default']],
            ['status', 'in', 'range' =>[
                self::STATUS_NOT_ACTIVE,
                self::STATUS_ACTIVE
            ]],
    ];
    }*/
    // null сохраненной модели или */null, если сохранение не удалось

   /* public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->status = $this->status;

        $user->username = $this->username;
        $user->email = $this->email;

        $user->save();
        $user->setPassword($this->password);
        $user->generateAuthKey();
        echo '<pre>'; print_r($user); die;


        //return $user->save() ? $user : null;

    }



}*/