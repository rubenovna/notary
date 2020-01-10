<?php
/**
 * Created by PhpStorm.
 * User: lilia
 * Date: 02.08.19
 * Time: 12:53
 */

namespace app\controllers;
use yii\web\Controller;
use Yii;


class AppController extends Controller
{
     const Role_Notary = 1;
       const Role_Client = 2;


       //переменная в котором храниться статус документа ;
    // status 1 означает документ новыйб, готов к выдачи status = 2
       const New_Status = 1;
       const Signed_Status = 2;



}