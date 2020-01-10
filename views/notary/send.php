<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<?php echo '<a href ="area">' .
    Html::submitButton('Назад', ['class' => 'btn btn-success']) . '</a><br><br>' ?>

<?php echo '<a href ="/reg/logout">' .
    Html::submitButton('Выйти', ['class' => 'btn btn-success']) . '</a><br><br>' ?>


<?php $form =ActiveForm::begin(['options'=>['id' => 'SendForm']])?>
<?= $form->field($model, 'doc_id')/*->label('Ваше имя')*/?>



<?= $form->field($model, 'file')->fileInput() ?>
<?= Html::submitButton('Отправить', ['class' =>'btn btn-success']).'<br><br><br>'?>


<?php ActiveForm::end() ?>