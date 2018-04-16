<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\switchinput\SwitchInput;
use kartik\widgets\Select2;
use kartik\form\ActiveField;
use kartik\widgets\DepDrop;

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
            <?= $form->field($model, 'nombre', [
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => [
                    'showIcon' => false,
                    'title' => '<i class="glyphicon glyphicon-info-sign"></i> Nota'
                ]
                ])->textInput()->hint('Ingrese el nombre/designación con que se describirá el objeto.'); ?>
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
                    echo $form->field($model, 'publicar_id')->widget(Select2::classname(), [
                            'data' => array('1'=>'Si','0'=>'No'),
                            'value' => ['Si'], // initial value
                            'options' => ['placeholder' => 'Si'],
                            'pluginOptions' => [
                                'allowClear' => false
                            ],
                        ]);
            ?>
        </div>  
    </div>   
        <div class="row">
              <div class="col-sm-3">
      <?php   
         echo   $form->field($model,  'nroC',[
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => [

                    'showIcon' => false,
                    'title' => '<i class="glyphicon glyphicon-info-sign"></i> Nota'
                ]
                ])->textInput()->hint('Es el la cantidad de elementos que tiene la serie. En elemento en la familia por número dentro de la serie (pueden ser letras y/o números ).')->label('Cantidad');  
    ?>
</div>
    <?php    
        echo Html::hiddenInput('fechaIngreso',$model->fechaIngreso);
        echo Html::hiddenInput('ingreso_id',$model->ingreso_id);
        
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,           
            'columns'=>3,
            'attributes'=>[       // 3 column layout                
                'nroA'=>[
                    'type'=>Form::INPUT_TEXT,
                    'label'=>'Nro. Temporario',                    
                    'options'=>[
                        'placeholder'=>'Número Temporario', 
                        'addon' => ['append' => ['content'=>'.00']]
                    ]
                ],
                'nroB'=>[
                    'type'=>Form::INPUT_TEXT,
                    'label'=>'Nro. de Registro Anterior',
                    'options'=>[
                            'placeholder'=>'Nro. de Registro Anterior'
                    ]
                ],
                // 'nroC'=>['type'=>Form::INPUT_TEXT, 
                //     'label'=>'Cantidad',                    
                //     'options'=>['placeholder'=>'historio',
                //     ]
                //],
                'nroD'=>['type'=>Form::INPUT_TEXT, 
                    'label'=>'Elemento en la Familia',                    
                    'options'=>['placeholder'=>'Elemento en la Familia']],
            ]
        ]);  
    
    ?>

</div>
</div>
