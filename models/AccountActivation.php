<?php
/**
 * Created by PhpStorm.
 * User: lilia
 * Date: 12.08.19
 * Time: 16:53
 */

namespace app\models;
use app\models\generated\Users;
use yii\base\InvalidParamException;
use yii\base\Model;







/*@property string $username */
class AccountActivation extends Model
{
    /* @var $users \app\models\generated\Users */
    private $_user;


    public function __construct($key, $config = [])
    {
        if (empty($key) || !is_string($key))
            throw new InvalidParamException('Ключь не может быть пустым');
        $this->_user = Users::findBySecretKey($key);
        if (!$this->_user)
            throw new InvalidParamException('Не верный ключ');
       // parent::_construct($config);
    }

    public function activateAccount(){
        $user = $this->_user;
        $user->status = Users::STATUS_ACTIVE;
        $user->removeSecretKey();
        /*var_dump($user);
        exit();*/
        $user->save();
       // return $user->save;
    }

    public function getUsername(){
        $user = $this->_user;
        return $user->username;
    }
}