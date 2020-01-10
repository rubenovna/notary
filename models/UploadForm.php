<?php
/**
 * Created by PhpStorm.
 * User: lilia
 * Date: 22.07.19
 * Time: 20:37
 */
namespace app\models;
use yii\base\Model;
use app\models\generated\Users;
use yii\web\UploadedFile;
class UploadForm extends Model
{
    public $file;
    public $name;
    public $email;
    public $text;
   public function attributeLabels()// спомощью этого метода меняем наименованией полей используем место labels в forme
    {
 return [
     'name'=>'Ваше имя',
     'email'=>'Ваш E-mail',
     'text'=>'Оставить комментарий',
     ];
    }
    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, pdf, jpg,jpeg'],
           [['name', 'email', 'text',], 'required'],
            [['name', 'email', 'text'], 'trim'],
            ['email', 'email'],
        ];
    }
}
