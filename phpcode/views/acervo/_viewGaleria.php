<?php
use yii\helpers\Html;
use kotchuprik\fotorama;
?>  

<div style="float:left;">
    <?php 
        echo Html::img( '@web' .$model->webPath, ['width'=>'192', 'height' => "200"]);
    ?> 
</div>



