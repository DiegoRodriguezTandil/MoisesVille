<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
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
    
    <?php //    die("--".$publicar); 
    $form = ActiveForm::begin(
            ['type'=>ActiveForm::TYPE_VERTICAL]
            );

    ?>

    <?php
        $dataPublicar=ArrayHelper::map(\app\models\Publicar::find()->asArray()->all(), 'id', 'id');
    ?>
    <div class="row">
        <div class="col-sm-4">     
            <?= $form->field($model, 'nombre')->textInput() ?>
        </div>

        <div class="col-sm-4">     
            <?= $form->field($model, 'nroInventario')->textInput() ?>
        </div>

        <div class="col-sm-4">

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
            'columns'=>6,
            'attributes'=>[       // 3 column layout                
                'nroA'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Número A..', 'addon' => ['append' => ['content'=>'.00']]]],
                'nroB'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Número B..']],
                'nroC'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Número C..']],
                'nroD'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Número D..']],
                'descEpoca'=>['type'=>Form::INPUT_TEXT, 'label'=>'Época data','options'=>['placeholder'=>'Epoca...']],
                'codformaing'=>['type'=>Form::INPUT_WIDGET, 'label'=>'Tipo de Ingreso',
                                    'widgetClass'=>'\kartik\widgets\Select2', 
                                    'options'=>['data'=>$dataForma ], 
                                   // 'hint'=>'Seleccione unidad de medida'
                    ],
            ]
        ]);

        $dataCopia = ArrayHelper::map(\app\models\Copia::find()->asArray()->all(), 'id', 'nombre');
        $dataEstado = ArrayHelper::map(\app\models\Estado::find()->asArray()->all(), 'id', 'nombre');
        $dataTipo = ArrayHelper::map(\app\models\TipoAcervo::find()->asArray()->all(), 'id', 'descripcion');
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>6,
            'attributes'=>[  
                'tipoAcervo_id'=>['type'=>Form::INPUT_WIDGET, 'label'=>'Tipo de Acervo',
                                    'widgetClass'=>'\kartik\widgets\Select2', 
                                    'options'=>['data'=>$dataTipo ],                                    
                    ],
                'copia_id'=>['type'=>Form::INPUT_WIDGET, 'label'=>'Tipo de Documento',
                                    'widgetClass'=>'\kartik\widgets\Select2', 
                                    'options'=>['data'=>$dataCopia ], 
                                   // 'hint'=>'Seleccione unidad de medida'
                    ],
                'estado_id'=>['type'=>Form::INPUT_WIDGET, 'label'=>'Estado',
                                    'widgetClass'=>'\kartik\widgets\Select2', 
                                    'options'=>['data'=>$dataEstado ], 
                                   // 'hint'=>'Seleccione unidad de medida'
                    ],
                'material'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Material...']],
                'forma'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Forma...']],
                'color'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Color...']],
                
            ]
        ]);
   
        $dataUbicacion = ArrayHelper::map(\app\models\Ubicacion::find()->asArray()->all(), 'id', 'nombre');
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>3,
            'attributes'=>[       // 2 column layout               
                'ubicacion_id'=>['type'=>Form::INPUT_WIDGET, 'label'=>'Ubicación',
                                    'widgetClass'=>'\kartik\widgets\Select2', 
                                    'options'=>['data'=>$dataUbicacion ], 
                                   // 'hint'=>'Seleccione unidad de medida'
                    ],
                'descUbicacion'=>['type'=>Form::INPUT_TEXT, 'label'=>'Más detalles ubicación','options'=>['placeholder'=>'Más detalles...']],
                'lugarprocac'=>['type'=>Form::INPUT_TEXT, 
                    'label'=>'Lugar de Procedencia',
                    'options'=>['placeholder'=>'Lugar de procedencia...']],
              
               
            ]
        ]);
       
    ?>
    
    <div class="row">
        <div class="col-sm-6"> 
            <?= $form->field($model, 'TemaIds')->widget(Select2::classname(), [
                'data'=>$model->dropTema,
                'options' => ['multiple' => true]
               ]);?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'ColeccionIds')->widget(Select2::classname(), [
                'data'=>$model->dropColeccion,
                'options' => ['multiple' => true]
               ]);?>
        </div>
    </div>
    
     <div class="row">
        <div class="col-sm-6">
            <?php 

                echo $form->field($model, 'descripcion', [
                            'hintType' => ActiveField::HINT_SPECIAL,
                            'hintSettings' => ['placement' => 'right', 'onLabelClick' => true, 'onLabelHover' => false]
                        ])->textArea([
                            'id' => 'descripcion', 
                            'placeholder' => 'Ingrese descripción...', 
                            'rows' => 4
                        ])->hint('Ingrese descripión. Recuerde que esa información en la que aparece en la web.');

            ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'notas')->textarea(['rows' => 4]) ?>
        </div>
    </div>
    
    <?php
        
        $dataUnidadMedida = ArrayHelper::map(\app\models\UnidadMedida::find()->asArray()->all(), 'id', 'descripcion');
        $dataUnidadPeso = ArrayHelper::map(\app\models\UnidadPeso::find()->asArray()->all(), 'id', 'descripcion');
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'attributes'=>[       // 2 column layout
                'ancho'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Ancho...']],
                'largo'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Largo...']],
                'alto'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Alto...']],
                'unidadMedida_id'=>['type'=>Form::INPUT_WIDGET, 
                                    'label'=>'Unidad de Medida',
                                    'widgetClass'=>'\kartik\widgets\Select2', 
                                    'options'=>['data'=>$dataUnidadMedida ], 
                                   // 'hint'=>'Seleccione unidad de medida'
                    ],  

                
            ]
        ]); 
             
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'attributes'=>[       // 2 column layout
                'diametroInterno'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Diametro Interno...']],
                'diametroExterno'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Diametro Externo...']],
                'peso'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Peso...']],
                'unidadPeso_id'=>['type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=>'\kartik\select2\Select2', 
                                    'label'=>'Unidad de Peso',
                                    'options' => [
                                        'data'=>ArrayHelper::map(\app\models\UnidadPeso::find()->orderBy('descripcion')->asArray()->all(), 'id', 'descripcion'), 
                                       // 'hint'=>'Seleccione unidad de peso',
                                       // 'options' => ['placeholder' => 'Procurar solicitante ...'],
                                ],
                    ]
            ]      
        ]);
    
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
