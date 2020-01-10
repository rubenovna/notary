<h1>Регистрация</h1>
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>





<?php $form =ActiveForm::begin(['options'=>['id' => 'testForm']])?><!--['options'=> ['class'=> 'form-horizontal']]- меняет вид формы вставляем в begin-->


<?= $form->field($model, 'username')/*->label('Ваше имя')*/?>
<?= $form->field($model, 'email')/*->label('Ваш Email')->input('email')*/?>
<?= $form->field($model, 'password')->passwordInput()/*->label('Ваш пароль')*/?>
<?= $form->field($model, 'role')->dropDownList([
    1 =>'Notary',
    2 => 'Client']);/*label('Текст')-*/?>





<?= Html::submitButton('Отправить', ['class' =>'btn btn-success'])?>


<?php ActiveForm::end()?>