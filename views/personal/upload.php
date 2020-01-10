<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>


<?php echo  '<a href ="/reg/logout">'.
Html::submitButton('Выйти', ['class' =>'btn btn-success']).'</a><br><br>'?>

<?php echo  '<a href ="area">'.
Html::submitButton('Личный кабинет', ['class' =>'btn btn-success']).'</a><br><br>'?>


<?php $form =ActiveForm::begin(['options'=>['id' => 'UploadForm']])?>

<?= $form->field($model, 'name')/*->label('Ваше имя')*/?>
<?= $form->field($model, 'email')/*->label('Ваш Email')->input('email')*/?>
<?= $form->field($model, 'text')->textarea(['rows' => 5])/*->label('Ваш Email')->input('email')*/?>

<?= $form->field($model, 'file')->fileInput() ?>
<?= Html::submitButton('Отправить', ['class' =>'btn btn-success']).'<br><br><br>'?>


<?php ActiveForm::end() ?>


<?php /*ActiveForm::end() */?>