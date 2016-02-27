<?php

/*use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;*/

use yii\helpers\Html;
use kartik\widgets\ActiveForm; // or yii\widgets\ActiveForm
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Multimedia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="multimedia-form">

    <?php 
    $form = ActiveForm::begin([ 'options'=>['enctype'=>'multipart/form-data'], // important
                                'type' => ActiveForm::TYPE_VERTICAL       
    ]);
    // your fileinput widget for single file upload
        echo $form->field($model, 'files[]')->widget(FileInput::classname(), [
            'options'=>['multiple' => true, 'accept'=>'image/*'],
            'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']
        ]]);
    
//        $form->field($model, 'webPath')->textInput(['maxlength' => true]) 
               
    ?>
  
    <?php 
//        $dataPost=ArrayHelper::map(\app\models\TipoMultimedia::find()->asArray()->all(), 'id', 'nombre');
//        echo $form->field($model, 'tipoMultimedia_id')
//        ->dropDownList(
//            $dataPost,
//            ['prompt' => '---'],
//            ['id'=>'tipoMultimedia_id'],
//            ['style'=>'width:50%']    
//        );
//    
    ?>

    <?php  echo Html::hiddenInput('Multimedia[objeto_id]',$acervo_id);  
           echo Html::hiddenInput('multimedia','si');  
           echo Html::hiddenInput('objeto_id',$acervo_id);  
    ?>

    <div class="form-group">
        <?= Html::submitButton('Subir fotos', array('name' => 'button1'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
