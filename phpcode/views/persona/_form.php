<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;

use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//use yii\web\JsExpression;


/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">

    <?php 
        $form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_VERTICAL,
            'id'=>$model->formName(),
        ]); 
    ?>
    
    <?= isset($acervo_id)? Html::hiddenInput('acervo_id',$acervo_id): '' ?>

    <?=
        Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>3,
            'attributes'=>[
                'apellido'=>[
                        'type'=>Form::INPUT_TEXT, 
                        'options'=>['placeholder'=>'Ingrese Apellido...']
                ],
                'nombre'=>[
                        'type'=>Form::INPUT_TEXT, 
                        'options'=>['placeholder'=>'Ingrese Nombre...']
                ],
                'fechaNacimiento'=>[
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>kartik\datecontrol\DateControl::className(), 
                        'hint'=>'Ingrese Fecha de Nacimiento (dd/mm/yyyy)',
                ],
            ]
        ]);
    ?>
    
    <?=
        Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>2,
            'attributes'=>[
                'mail'=>[
                        'type'=>Form::INPUT_TEXT, 
                        'options'=>['placeholder'=>'Ingrese Mail...'],                    
                ],
                'telefono'=>[
                        'type'=>Form::INPUT_TEXT, 
                        'options'=>['placeholder'=>'Ingrese Teléfono...']
                ],
            ]
        ]);
    ?>

    <?php
/*    
//        $dataLocalidad=ArrayHelper::map(\app\models\Localidad::find()->asArray()->all(), 'id', 'nombre');
        $localidadNombre = empty($model->localidad_id) ? '' : \app\models\Localidad::findOne($model->localidad_id)->nombre;
//        $dataLocalidad = ArrayHelper::map(\app\models\Localidad::findOne($model->localidad_id), 'id', 'nombre');
//        var_dump($dataLocalidad);
//        var_dump(\app\models\Localidad::findOne($model->localidad_id));
//        $l = \app\models\Localidad::findOne($model->localidad_id);
//        $dataLocalidad = [
//            $l->id => $l->nombre,
//        ];
            
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>2,
            'attributes'=>[
                'domicilio'=>[
                        'type'=>Form::INPUT_TEXT, 
                        'options'=>['placeholder'=>'Ingrese Domicilio...']
                ],
                'localidad_id'=>[
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>'\kartik\select2\Select2', 
                    
                        'options' => [
                            'initValueText' => $localidadNombre,
                            'options' => ['placeholder' => 'Seleccione Ciudad...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumInputLength' => 3,
                                'errorLoading' => 'Buscando ...',
                                'ajax' => [
                                    'url' => \yii\helpers\Url::to(['localidad/find']),
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('function(city) { return city.nombre; }'),
                                'templateSelection' => new JsExpression('function (city) { return city.nombre; }'),
                            ],
                        ],
                ],
            ]
        ]);
 
 */    
        $dataLocalidad = ArrayHelper::map(\app\models\Localidad::find()->asArray()->all(), 'id', 'nombre');
        
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>2,
            'attributes'=>[
                'domicilio'=>[
                        'type'=>Form::INPUT_TEXT, 
                        'options'=>['placeholder'=>'Ingrese Domicilio...']
                ],
                'localidad_id'=>[
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>'\kartik\select2\Select2', 
                        'options' => [
                            'options' => ['placeholder' => 'Seleccione Ciudad...'],
                            'data' => $dataLocalidad,
                            'pluginOptions' => [
                                'allowClear' => true
                            ],                            
                        ],
                ],
            ]
        ]);    
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
