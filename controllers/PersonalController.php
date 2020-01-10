<?php
/**
 * Created by PhpStorm.
 * User: lilia
 * Date: 31.07.19
 * Time: 15:14
 */

//namespace app\controllers\base;
namespace app\controllers;

//use yii\web\Controller;
use app\models\generated\DocData;

use app\models\generated\Documents;
use app\models\generated\Users;
use app\models\UploadForm;
use yii\web\UploadedFile;

use Yii;

//use app\controllers\AppController;

class PersonalController extends AppController
{

    public function actionArea()
    {

        $this->view->title = "Личный кабинет";

        $session = Yii::$app->session;

            $role = $session->get('role');
            $id = $session->get('id');




        if ($role== self::Role_Client) {

            $query = new \yii\db\Query();

            $query->select('*')
                ->from('`documents`')
                ->innerJoin('`doc_data`', '`documents`.`user_id` = `doc_data`.`user_id`')
                ->innerJoin('`doc_statuses`', '`documents`.`doc_status` = `doc_statuses`.`id`')

                ->where(['`documents`.`user_id`' => $id]);
            $command = $query->createCommand();
            $path_db = $command->queryAll();


            return $this->render('area', ['path' => $path_db]);

        } else {
            return $this->redirect(['notary/area']);
        }
    }


    public function actionUpload()
    {
        $this->view->title = "Загрузка файла";

        $model = new UploadForm();


        $session = Yii::$app->session;

        if (isset($session['role'])) {
            $role = $session->get('role');
        }

        if (isset($session['id'])) {
            $id = $session->get('id');
        }


        if ($model->load(Yii::$app->request->post())) {

            if (Yii::$app->request->isPost) {
                $model->file = UploadedFile::getInstance($model, 'file');

                if ($model->file && $model->validate()) {
                    $model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);
                    $path = ('uploads/' . $model->file);

                    $tik = hash_file('md5', $path);
                    $rest = substr($tik, 0, 4);
                    $ret = substr($tik, 4, 8);
                    $uk = 'uploads/' . $rest . '/' . $ret . '/' . $tik. '.' . $model->file->extension;


                    if (!file_exists($uk)) {

                        $save = 'uploads/' . $rest . '/' . $ret . '/';
                        mkdir($save, 0755, true);
                        $model->file->saveAs($save . $tik);
                        rename($path, $save . $tik . '.' . $model->file->extension);
                        $url = $save . $tik . '.' . $model->file->extension;

                       $newDoc_data = new DocData();
                        $newDoc_data->name = $model->name;
                        $newDoc_data->email = $model->email;
                        $newDoc_data->text = $model->text;
                        $newDoc_data->role = $role;
                        $newDoc_data->user_id = $id;
                        $newDoc_data->save();



                        $newDocuments = new Documents();
                        $newDocuments->path = $url;
                        $newDocuments->role = $role;
                        $newDocuments->user_id = $id;
                        $newDocuments->doc_status = self::New_Status;
                        $newDocuments->save();
                        if ($newDocuments->save()) {

                        // отправляем письмо
                             $notaries = Users::find()
                        ->where(['role' => 1])
                         ->one();

                                $email = $notaries->email;

                                Yii::$app->mailer->compose('notary', ['doc_data'=> $newDoc_data])
                        ->setFrom([\Yii::$app->params['supportEmail'] => Yii::$app->name . ' (отправлено роботом).'])
                        ->setTo($email)
                        ->setSubject('Новый заказ для Вас ' . Yii::$app->name)
                        ->send();

                    echo 'Письмо  отправлено, ';
                            //обнуляем модель, чтобы очистить форму,
                            $model = new UploadForm();
                            echo "ваш файл загружен";//reset model
                            //отправляем сообщение об успешном сохранении

                              }
                           else {
                              echo "произошла ошибка при сохронении данных";
                          }
                        } else {
                            unlink($path);
                            echo "такой файл существует";

                        }
                    } else {
                        echo "ошибка c валидацией ";
                    }

                } else {
                    echo "произошда ошибка ";
                }


            }
            return $this->render('upload', compact('model'));

        }


        public
        function actionDelete()
        {

            $model = new UploadForm();
            $session = Yii::$app->session->get('id');

            $name = Documents::find()
                ->where('user_id=:session', [':session' => $session])
                ->one();

            $doc_date = DocData::find()
                ->where('user_id=:session', [':session' => $session])
                ->one();
            $name->delete();
            $doc_date->delete();

            return $this->redirect(['personal/area']);
        }




    }