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
    $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data'] // important
    ]);
    // your fileinput widget for single file upload
        echo $form->field($model, 'file[]')->widget(FileInput::classname(), [
            'options'=>['accept'=>'image/*', 'multiple'=>true],
            'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']
        ]]);
    ?>
    
    
     <?php //echo Html::hiddenInput('Multimedia[objetos_id]',$objeto_id); 
       echo $form->field($model, 'objetos_id')->textInput(['maxlength' => true])
     ?>
    

    <?php 
        $dataPost=ArrayHelper::map(\app\models\TipoMultimedia::find()->asArray()->all(), 'id', 'nombre');
        echo $form->field($model, 'tipoMultimedia_id')
        ->dropDownList(
            $dataPost,
            ['prompt' => '-Seleccionar Tipo-'],
            ['id'=>'tipoMultimedia_id'],
            ['style'=>'width:50%']    
        );
    
    ?>

    <?php //= $form->field($model, 'objetos_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
