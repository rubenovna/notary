<?php
/**
 * Created by PhpStorm.
 * User: lilia
 * Date: 13.08.19
 * Time: 14:03
 */

namespace app\controllers;
use app\models\generated\Documents;
use app\models\WhateverYourModel;
use yii;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\UploadedFile;


class FormController extends AppController
{


// action examples

    public function actionUpload()
    {


        $imageFile = UploadedFile::getInstanceByName('userImage');

        $directory ='uploads/';
        if (!is_dir($directory)) {
            yii\helpers\FileHelper::createDirectory($directory);
        }

        if ($imageFile) {
            $uid = uniqid(time(), true);
            $fileName = $uid . '.' . $imageFile->extension;
            $filePath = $directory . $fileName;

            if ($imageFile->saveAs($filePath)) {
                $path = Url::to('uploads/' . $fileName, true);

                return Json::encode([
                    'files' => [
                        [
                            'name' => $fileName,
                            'size' => $imageFile->size,
                            'url' => $path,
                            'thumbnailUrl' => $path,
                            'deleteUrl' => 'image-delete?name=' . $fileName,
                            'deleteType' => 'POST',
                        ],
                    ],
                ]);
            }
        }

        return $this->render( 'form');
    }






}