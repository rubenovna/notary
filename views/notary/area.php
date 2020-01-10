<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php echo '<br><br>'. '<a href ="/notary/send">'.
    Html::submitButton('Личный кабинет', ['class' =>'btn btn-success']).'</a><br><br>'?>


<?php echo '<a href ="/reg/logout">' .
    Html::submitButton('Выйти', ['class' => 'btn btn-success']) . '</a><br><br>' ?>
<div class="row">
    <?php foreach ($resp as $key => $value) {
        ?>
        <div class="col-md-3">
            <div class="card" style="height: 455px">
                <img src="<?php echo Yii::getAlias('@web') . '/' . $value['path']; ?>" class="card-img-top"
                     width="255px">
                <div class="card-body">
                    <h3 class="card-title" style="word-wrap: break-word"><?php echo $value['name'].'<br>'; ?></h3>
                    <h5 class="card-title" style="word-wrap: break-word"><i>Идентификационный номер документа<?php echo " - ". $value['doc_id'].'<br>'; ?></i></h5>
                    <h5 class="card-title" style="word-wrap: break-word"><?php echo '<i>'.'Статус'. '   ' . $value['description'].'</i>'; ?></h5>
                    <div class="text-right">
                        <?php
                        echo Html::a('Скачать', ['download', 'doc_id' => $value['doc_id']], ['class' => 'btn btn-primary']);?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div>


