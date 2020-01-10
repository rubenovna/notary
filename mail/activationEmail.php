<?php
/**
 * Created by PhpStorm.
 * User: lilia
 * Date: 12.08.19
 * Time: 16:48
 * @var $this yii\web\View
 * @var $users \app\models\generated\Users
 */
use yii\helpers\Html;
$session = Yii::$app->session;
$username = $session->get('username');
$secret_key = $session->get('secret_key');
/*var_dump($session['username'], $session['secret_key'] );
                    exit();*/

echo 'Привет '.Html::encode($username).'.';
echo Html::a('Для активации аккаунта перейдите по этой ссылке.',
    Yii::$app->urlManager->createAbsoluteUrl(
        [
            '/reg/activate-account',
            'key' => $secret_key
        ]
    ));