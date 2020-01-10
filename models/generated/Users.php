<?php

namespace app\models\generated;



use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $status
 * @property string $auth_key
 * @property string $role
 * @property string $secret_key

 */
class Users extends ActiveRecord implements IdentityInterface
{

    const STATUS_DELETE = 0;
    const STATUS_NOT_ACTIVE =20;
    const STATUS_ACTIVE = 10;
    const Role_Client = 2;
    const Role_Notary = 1;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'trim'],
            [['username', 'email', 'password', 'role'], 'required'],
            [['username', 'email', ], 'string', 'max' => 25],
            [[ 'password','auth_key',], 'string', 'max' => 255],
            ['secret_key', 'unique'],




        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'status' => 'Status',
            'auth_key' => 'Auth Key',
             'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'role' => 'Роль',

        ];
    }



    //поведение
    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    //поиск

    public static function findByUsername($username)

    {
        return static ::findOne([
            'username' => $username
        ]);
    }


    /* Находит пользователя по емайл */
    public static function findByEmail($email)
    {
        return static::findOne([
            'email' => $email
        ]);
    }



    public static function isSecretKeyExpire($key)
    {
        if (empty($key))
        {
            return false;
        }
        $expire = Yii::$app->params['secretKeyExpire'];
        $parts = explode('_', $key);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }





    public static function findBySecretKey($key)
    {
        if (!static::isSecretKeyExpire($key))
        {
            return null;
        }
        return static::findOne([
            'secret_key' => $key,
        ]);
    }



    /* Хелперы */
    public function generateSecretKey()
    {
        $this->secret_key = Yii::$app->security->generateRandomString().'_'.time();
    }





    public function removeSecretKey()
    {
        $this->secret_key = null;
    }







    public static function findIdentity($id){
        return static::findOne([
            'id' => $id,
            'status' => self::STATUS_ACTIVE,
        ]);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        //throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        return static::findOne(['access_token' => $token]);

    }



    public function getId()
    {
        return $this->id;
    }


    public function getAuthKey()
    {
        return $this->auth_key;

    }


    public function validateAuthKey($authKey){
        return $this->/*auth_key*/getAuthKey() === $authKey;

    }

    public function setPassword($password)
    {

        $this->password = Yii::$app->security->generatePasswordHash($password);

         /*var_dump($this->password);
          exit();*/
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();

    }

    public function validatePassword($password)
    {
        /*var_dump($password, $this->password);
        exit();*/
        return Yii::$app->security->$this->validatePassword($password, $this->password);

    }


}
