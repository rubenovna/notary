<?php
/**
 * Created by PhpStorm.
 * User: lilia
 * Date: 31.07.19
 * Time: 18:22
 */

namespace app\controllers;
use app\models\generated\Documents;
use app\models\generated\Users;
use app\models\SendForm;

use app\models\UploadForm;
use yii\web\UploadedFile;

use Yii;





class NotaryController extends AppController
{

     public function actionArea()
    {
         $this->view->title = "Нотариусы";


        $query = new \yii\db\Query();
        $query->select('*')
            ->from('`documents`')
            ->innerJoin('`doc_data`', '`documents`.`user_id` = `doc_data`.`user_id`')
            ->leftJoin('`doc_statuses`', '`documents`.`doc_status` = `doc_statuses`.`id`');

        $command = $query->createCommand();
        $resp = $command->queryAll();

        return $this->render('area', ['resp' => $resp]);
    }






    public function actionSend()
    {


        $this->view->title = "Отправить файл клиенту";
        $model = new SendForm();
        $newUser = new Users();

        if ($model->load(Yii::$app->request->post())) {
            $doc_id = $model->doc_id;
            $d_id = Documents::find()
                ->where('doc_id =:doc_id', [':doc_id' => $doc_id])
                ->one();

            
            if ($doc_id != $d_id['doc_id']) {
                echo "Проверьте идентификационный номер документа";
            } else {
                if (Yii::$app->request->isPost) {
                    $model->file = UploadedFile::getInstance($model, 'file');


                    if ($model->file && $model->validate()) {

                        $model->file->saveAs('signet/' . $model->file->baseName . '.' . $model->file->extension);
                        $path = ('signet/' . $model->file);

                        $tik = hash_file('md5', $path);
                        $rest = substr($tik, 0, 4);
                        $ret = substr($tik, 4, 8);
                        $uk = 'signet/' . $rest . '/' . $ret . '/' . $tik . '.' . $model->file->extension;

                        if (!file_exists($uk)) {
                            $save = 'signet/' . $rest . '/' . $ret . '/';
                            mkdir($save, 0755, true);
                            $model->file->saveAs($save . $tik);
                            rename($path, $save . $tik . '.' . $model->file->extension);
                            $url = $save . $tik . '.' . $model->file->extension;


                            Yii::$app->db->createCommand()
                                ->update('documents', ['signet_path' => $url, 'doc_status' => self:: Signed_Status])
                                ->execute();


                            //отправляем письмо клиенту сообщая о том, что заказ выполнен

                            $client = Users::find()
                                ->where('id =:doc_id', [':doc_id' => $d_id['user_id']])
                                ->one();

                            $email = $client->email;

                                Yii::$app->mailer->compose('client', ['client'=> $client, 'data_id'=>$d_id['doc_id']])
                        ->setFrom([\Yii::$app->params['supportEmail'] => Yii::$app->name . ' (отправлено роботом).'])
                        ->setTo($email)
                        ->setSubject('Заказ Выполнен' . Yii::$app->name)
                        ->send();

                    echo 'Письмо  отправлено клиенту.';

                        } else {

                            unlink($path);
                            echo "такой файл существует";


                        }


                    } else {
                        echo "ошибка при валидации";

                    }
                } else {
                    echo "призошла ошибка прпи загрузке файла";

                }
            }

        }
        return $this->render('send', compact('model'));
    }











    public function actionDownload($doc_id){
         $data = Documents::findOne($doc_id);
         header('Content-Type:'. pathinfo($data->path, PATHINFO_EXTENSION));
         header('Content-Disposition: attachment; path=' .$data->path);
         return readfile($data->path);
     }




}