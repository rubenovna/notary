<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;


?>



<?php echo  '<a href ="/reg/logout">'.
    Html::submitButton('Выйти', ['class' =>'btn btn-success']).'</a><br><br>'?>

<?php echo  '<a href ="/personal/upload">'.
    Html::submitButton('Загрузить', ['class' =>'btn btn-success']).'</a><br><br>'?>


<div>

    <table class="table table-striped table-bordered table-hover">
        <thead><tr>
            <td>user_id</td>

            <td>ФИО</td>

            <td>Коментарий</td>

            <td>email</td>

            <td>файл</td>
            <td> Скачать</td>
            <td>Подписан</td>
            <td> Скачать</td>
             <td> Удалить</td>
        </tr>
        </thead>
        <?php foreach ($path as $key => $value){
            ?>
            <tr>
                <td><?=$value['user_id']?></td>

                <td><?=$value['name']?></td>

                <td><?=$value['text']?></td>

                <td><?=$value['email']?></td>



                <td><?=$value['path']?></td>
                <td><?=' <a href = "/' . $value['path'] .'" download> Скачать</a>'?></td>


                 <td><?=$value['description']?></td>
                <td><?=' <a href = "/' . $value['signet_path'] .'" download> Скачать</a>'?></td>


                <td>

                    <?php echo  '<a href ="/personal/delete">'.
                        Html::submitButton('Удалить', ['class' =>'btn btn-success'])?>




                </td>

            </tr>
            <?php
        }
        ?>


    </table>

</div>