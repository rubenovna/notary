<?php
/**
 * Created by PhpStorm.
 * User: lilia
 * Date: 31.07.19
 * Time: 18:43
 */



namespace app\models;
use yii\base\Model;
class SendForm extends Model
{
    public $file;
    public $doc_id;
    public $email;
    public function attributeLabels()// спомощью этого метода меняем наименованией полей используем место labels в forme
    {
        return [
            'doc_id'=>'Идентификационный номер документа',
            'email'=>'E-mail клиента',
        ];
    }
    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, pdf, jpg, jpeg'],
            [['doc_id', 'email', ], 'required'],
            [['doc_id', 'email',], 'trim'],
            ['email', 'email'],
        ];
    }
}

