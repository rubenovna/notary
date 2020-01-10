<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<h1>Войти</h1>



<?php $form =ActiveForm::begin(['options'=>['id' => 'testForm']])?><!--['options'=> ['class'=> 'form-horizontal']]- меняет вид формы вставляем в begin-->


<?= $form->field($model, 'username')/*->label('Ваше имя')*/?>
<?= $form->field($model, 'password')->passwordInput()/*->label('Ваш пароль')*/?>
<?= $form->field($model, 'role')->dropDownList([
    1 =>'Notary',
    2 => 'Client']);/*label('Текст')-*/?>

<?= $form->field($model, 'rememberMe')->checkbox() ?>
<?= Html::submitButton('Отправить', ['class' =>'btn btn-success'])?>


<?php ActiveForm::end()?>




<?php  $this->registerCss('.container{background: #2aabd2;;}')?>
<?php
$js = <<<JS
$('#btn').on('click', function() {
    $.ajax({
    url:'index.php?r=regis/index',
    data: {test: '123'},
    type: 'POST',
    success: function(res) {
        console . log(res);
        },
        error:function() {
          alert('Error');
        }
    })
  
})
JS;
$this->registerJs($js);
?>
