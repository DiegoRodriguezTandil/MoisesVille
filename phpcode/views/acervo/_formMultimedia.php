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
        echo $form->field($model, 'path')->widget(FileInput::classname(), [
            'options'=>['accept'=>'image/*'],
            'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']
        ]]);
    ?>
    
    <?= $form->field($model, 'webPath')->textInput(['maxlength' => true]) ?>
  
    <?php 
        $dataPost=ArrayHelper::map(\app\models\TipoMultimedia::find()->asArray()->all(), 'id', 'nombre');
        echo $form->field($model, 'tipoMultimedia_id')
        ->dropDownList(
            $dataPost,
            ['prompt' => '---'],
            ['id'=>'tipoMultimedia_id'],
            ['style'=>'width:50%']    
        );
    
    ?>

    <?php  echo Html::hiddenInput('Multimedia[objeto_id]',$acervo_id);  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
