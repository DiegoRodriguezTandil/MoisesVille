<?php

use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\widgets\Select2;
use kartik\form\ActiveField;

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acervo-form">  
    <?php 
        $dataForma = ArrayHelper::map(\app\models\FormaIngreso::find()->asArray()->all(), 'id', 'nombre');
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,           
            'columns'=>2,
            'attributes'=>[                 
                'descEpoca'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Epoca...']],
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
    <?php   
        $dataCopia = ArrayHelper::map(\app\models\Copia::find()->asArray()->all(), 'id', 'nombre');
        $dataEstado = ArrayHelper::map(\app\models\Estado::find()->asArray()->all(), 'id', 'nombre');
        $dataTipo = ArrayHelper::map(\app\models\TipoAcervo::find()->where(['tipoAcervo_id' => NULL])->asArray()->all(), 'id', 'descripcion');
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>6,
            'attributes'=>[  
                'tipoAcervo_id'=>['type'=>Form::INPUT_WIDGET, 'label'=>'Tipo de Acervo',
                                    'widgetClass'=>'\kartik\widgets\Select2', 
                                    'options'=>['data'=>$dataTipo ],                                    
                    ],
                'copia_id'=>['type'=>Form::INPUT_WIDGET,
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
    ?>

     <div class="row">
        <div class="col-sm-6">
            <?php 

                echo $form->field($model, 'caracteristicas', [
                            'hintType' => ActiveField::HINT_SPECIAL,
                            'hintSettings' => ['placement' => 'right', 'onLabelClick' => true, 'onLabelHover' => false]
                        ])->textArea([
                            'id' => 'caracteristicas', 
                            'placeholder' => 'Ingrese descripción...', 
                            'rows' => 4
                        ])->hint('Ingrese Caracterísiticas. Recuerde que esa información en la que aparece en la web.');

            ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'notas')->textarea(['rows' => 4]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6"> 
            <?php 
                $dataClasifG = ArrayHelper::map(\app\models\ClasificacionGenerica::find()->asArray()->all(), 'id', 'nombre');
                echo  $form->field($model, 'clasificacionGenerica_id')->widget(Select2::classname(), [
                'data'=>$dataClasifG               
               ]);?>
        </div>
    </div>
    
    <?php
//        
//        $dataUnidadMedida = ArrayHelper::map(\app\models\UnidadMedida::find()->asArray()->all(), 'id', 'descripcion');
//        $dataUnidadPeso = ArrayHelper::map(\app\models\UnidadPeso::find()->asArray()->all(), 'id', 'descripcion');
//        echo Form::widget([
//            'model'=>$model,
//            'form'=>$form,
//            'columns'=>4,
//            'attributes'=>[       // 2 column layout
//                'ancho'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Ancho...']],
//                'largo'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Largo...']],
//                'alto'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Alto...']],
//                'unidadMedida_id'=>['type'=>Form::INPUT_WIDGET, 
//                                    'label'=>'Unidad de Medida',
//                                    'widgetClass'=>'\kartik\widgets\Select2', 
//                                    'options'=>['data'=>$dataUnidadMedida ], 
//                                   // 'hint'=>'Seleccione unidad de medida'
//                    ],  
//
//                
//            ]
//        ]); 
//             
//        echo Form::widget([
//            'model'=>$model,
//            'form'=>$form,
//            'columns'=>4,
//            'attributes'=>[       // 2 column layout
//                'diametroInterno'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Diametro Interno...']],
//                'diametroExterno'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Diametro Externo...']],
//                'peso'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Peso...']],
//                'unidadPeso_id'=>['type'=>Form::INPUT_WIDGET, 
//                                    'widgetClass'=>'\kartik\select2\Select2', 
//                                    'label'=>'Unidad de Peso',
//                                    'options' => [
//                                        'data'=>ArrayHelper::map(\app\models\UnidadPeso::find()->orderBy('descripcion')->asArray()->all(), 'id', 'descripcion'), 
//                                       // 'hint'=>'Seleccione unidad de peso',
//                                       // 'options' => ['placeholder' => 'Procurar solicitante ...'],
//                                ],
//                    ]
//            ]      
//        ]);
    
    ?>

</div>
