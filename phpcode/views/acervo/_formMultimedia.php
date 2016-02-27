<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm; // or yii\widgets\ActiveForm
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;

?>

<div class="multimedia-form">

    <?php 

        echo $form->field($model, 'files[]')->widget(FileInput::classname(), [
            'options'=>['multiple' => true, 'accept'=>'image/*'],
            'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']
        ]]);
    
    ?>
  
    <?php  
        echo Html::hiddenInput('Multimedia[objeto_id]',$acervo_id);  
        echo Html::hiddenInput('multimedia','si');  
        echo Html::hiddenInput('objeto_id',$acervo_id);  
    ?>

    <!-- div class="form-group">
        <?= Html::submitButton('Subir fotos', array('name' => 'button1'), ['class' => 'btn btn-primary']) ?>
    </div -->

</div>
