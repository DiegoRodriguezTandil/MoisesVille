<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\switchinput\SwitchInput;
use kartik\widgets\Select2;
use kartik\form\ActiveField;
use yii\bootstrap\Modal;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acervo-form">   
    
    <?php
        $dataPublicar=ArrayHelper::map(\app\models\Publicar::find()->asArray()->all(), 'id', 'id');
    ?>
    <div class="row">
        <div class="col-sm-3">     
            <?= $form->field($model, 'nroInventario')->textInput() ?>
        </div>

        <div class="col-sm-3">     
            <?= $form->field($model, 'nombre')->textInput() ?>
        </div>              
        <div class="col-sm-3">
            <?php   
                $dataForma = ArrayHelper::map(\app\models\FormaIngreso::find()->asArray()->all(), 'id', 'nombre');
                echo $form->field($model, 'codformaing')->widget(Select2::classname(), [
                    'data' => $dataForma,
                    'options' => ['placeholder' => '', 'label'=>'Tipo de Ingreso'],                    
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            ?>
        </div>
        <div class="col-sm-3">
            <?php 
                    echo $form->field($model, 'publicar_id')->widget(SwitchInput::classname(), ['pluginOptions' => [
                            'onText' => 'Si',
                            'offText' => 'No',
                        ],'inlineLabel' => false,]);                
            ?>
        </div>  
    </div>   
    
    <?php    
        echo Html::hiddenInput('fechaIngreso',$model->fechaIngreso);
        echo Html::hiddenInput('ingreso_id',$model->ingreso_id);
        
        $dataForma = ArrayHelper::map(\app\models\FormaIngreso::find()->asArray()->all(), 'id', 'nombre');
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,           
            'columns'=>4,
            'attributes'=>[       // 3 column layout                
                'nroA'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Número A..', 'addon' => ['append' => ['content'=>'.00']]]],
                'nroB'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Número B..']],
                'nroC'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Número C..']],
                'nroD'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Número D..']],
//                'descEpoca'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Epoca...']],
//                'codformaing'=>[
//                    'type'=>Form::INPUT_WIDGET, 
//                    'label'=>'Tipo de Ingreso',
//                    'widgetClass'=>'\kartik\widgets\Select2', 
//                    'options'=>['data'=>$dataForma ], 
//                    // 'hint'=>'Seleccione unidad de medida'
//                ],
            ]
        ]);       
    ?>
</div>
