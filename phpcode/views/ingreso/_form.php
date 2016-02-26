<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
//use yii\helpers\ArrayHelper;
use kartik\builder\Form;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\web\JsExpression;


/* @var $this yii\web\View */
/* @var $model app\models\Ingreso */
/* @var $form yii\widgets\ActiveForm */

?>


<div class="ingreso-form">

    <?php /* $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-4',
                            'offset' => 'col-sm-offset-4',
                            'wrapper' => 'col-sm-8',
                            'error' => '',
                            'hint' => '',
                        ],
                    ],
                ]); */
        $form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_VERTICAL,
            'id'=>$model->formName(),
        ]); 
        
//        echo Form::widget([
//                'model'=>$model,
//                'form'=>$form,
//                'attributes'=>[       
//                    'autoSave'=>[
//                        'type'=>Form::INPUT_HIDDEN, 
//                    ],
//                ]
//            ]);
        echo Html::hiddenInput('Ingreso[autoSave]',$model->autoSave);
        echo Html::hiddenInput('id',$model->id);
        

        
        echo Form::widget([
                'model'=>$model,
                'form'=>$form,
                'columns'=>2,
                'attributes'=>[       // 2 column layout
                    'descripcion'=>[
                        'type'=>Form::INPUT_TEXTAREA, 
                        'options'=>['placeholder'=>'Ingrese Descripción...']
                    ],
                    'observaciones'=>[
                        'type'=>Form::INPUT_TEXTAREA, 
                        'options'=>['placeholder'=>'Ingrese Observaciones...']
                    ],
                   ]
            ]);
               
        echo Html::hiddenInput('action',null, array('id'=>'action'));
        echo Html::hiddenInput('user_id',Yii::$app->user->id, array('id'=>'user_id'));
    
    ?>  

    <?php
        echo Form::widget([
                'model'=>$model,
                'form'=>$form,
                'columns'=>2,
                'attributes'=>[       // 2 column layout
                    'fechaEntrada'=>[
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>kartik\datecontrol\DateControl::className(), 
                        'hint'=>'Ingrese Fecha de Alta (dd/mm/yyyy)',
                    ],
                    'fechaBaja'=>[
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>kartik\datecontrol\DateControl::className(), 
                        'hint'=>'Ingrese Fecha de Baja (dd/mm/yyyy)'
                    ],
                   ]
            ]);
    ?>
    
    <div>

    <?php
        $dataPersona = \yii\helpers\ArrayHelper::map(\app\models\Persona::find()->asArray()->all(), 'id', 'nombre');
        
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>1,            
            'attributes'=>[
                'persona_id'=>[
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>'\kartik\select2\Select2', 'label'=>'Persona Donante',
                        'options' => [
                            'options' => ['placeholder' => 'Seleccione Persona...'],                           
                            'data' => $dataPersona,
                            'pluginOptions' => [
                                'allowClear' => true
                            ],                            
                        ],
                ],
            ]
        ]);    
    ?>
        
    </div>
    
    <div>       
    <?php 
        $heading = '<i class="glyphicon glyphicon-book"></i> Objetos';                        
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute'=>'nombre',
                'vAlign'=>'middle',
                'format'=>'raw',
              //  'width'=>'150px',
                'noWrap'=>true
            ],
            [
                //  'class' => 'kartik\grid\EditableColumn',
                  'attribute' => 'nroInventario',
                  'vAlign'=>'middle',
                  'headerOptions'=>['class'=>'kv-sticky-column'],
                  'contentOptions'=>['class'=>'kv-sticky-column'],
               //   'editableOptions'=>['header'=>'Name', 'size'=>'md']
              ],
            [
                'class'=>'kartik\grid\ActionColumn',
                //'dropdown'=>$this->dropdown,
                'dropdownOptions'=>['class'=>'pull-right'],
                'urlCreator'=>function($action, $model, $key, $index) { 
                    if ($action == 'update' ) {
                        return Url::toRoute(['acervo/update-ingreso', 'id' => $key]);
                    }
                    if ($action == 'view' ) {
                        return Url::toRoute(['acervo/viewingreso', 'id' => $key]);
                    }
                    if ($action == 'delete' ) {
                        return Url::toRoute(['acervo/delete', 'id' => $key]);
                    }      
                },
                'viewOptions'=>['title'=>'Ver detalles del objeto', 'data-toggle'=>'tooltip'],
                'updateOptions'=>['url'=>'urlCreator', 'title'=>'Para actualizar el objeto', 'data-toggle'=>'tooltip'],
                'deleteOptions'=>['url'=>'urlCreator', 'title'=>'Eliminar el objeto', 'data-toggle'=>'tooltip'],
                'headerOptions'=>['class'=>'kartik-sheet-style'],
            ],
        ];

        echo GridView::widget([
            'dataProvider'=>$dataObject,
           // 'filterModel'=>$searchModel,
            'columns'=>$gridColumns,
            'resizableColumns'=>true,
            'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
            'headerRowOptions'=>['class'=>'kartik-sheet-style'],
            'filterRowOptions'=>['class'=>'kartik-sheet-style'],

            'pjax'=>true, // pjax is set to always true for this demo
   
            // set your toolbar
            'toolbar'=> [ 
                ['content'=>
                     Html::submitButton(
                        '<i class="glyphicon glyphicon-plus"></i>', 
                        [
                            'class' => 'btn btn-success',
                            'name' => 'newObjectButton',
                            'id' => 'newObjectButton',
                            'value' => 'newObjectButton',
                            'onClick' => "jQuery('#action').val('". \app\controllers\IngresoController::NEW_OBJECT ."')",
                        ]
                    )
        //            Html::button('<i class="glyphicon glyphicon-plus"></i>', 
        //                    ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success', 'href' => Url::toRoute(['/objeto/create']),])
        //            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
                ],
                //'{export}',
            ],

            // parameters from the demo form
            'bordered'=>true,
            'striped'=>true,
            'condensed'=>true,
            'responsive'=>true,
            'hover'=>true,
            'showPageSummary'=>false,
            'panel'=>[
                'type'=>GridView::TYPE_PRIMARY,
                'heading'=>$heading,
            ],
            'persistResize'=>false,

        ]);                       
                            
                            
    ?>        
        
    </div>

    </div>   
    
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitInput(
                    $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), 
                    [
                        'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                        'name' => 'saveButton',
                        'id' => 'saveButton',
                        'value' => 'saveButton',
                        'onClick' => "jQuery('#action').val('". \app\controllers\IngresoController::USER_SAVE_INGRESO ."')",
                    ]) 
            ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
