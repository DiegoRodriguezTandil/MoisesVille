<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Organizacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organizacion-form">

    <?php  $form = ActiveForm::begin(
            ['type'=>ActiveForm::TYPE_VERTICAL, 'options'=>['enctype'=>'multipart/form-data'] ]
             
            ); ?>

    <?php //echo $form->field($model, 'id')->textInput()
    $dataOrg=ArrayHelper::map(\app\models\OrganizacionTipo::find()->asArray()->all(), 'id', 'descripcion');
              
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>3,
            'attributes'=>[       // 2 column layout
                'nombre'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nombre...']],                
                    'organizacionTipo_id'=>['type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>'\kartik\widgets\Select2', 
                        'options'=>['data'=>$dataOrg ], 
                        // 'hint'=>'Seleccione unidad de medida'
                    ], 
                'telefono'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nro Inventario...']],
            ]
        ]);
        
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=> 5,
            'attributes'=>[       // 2 column layout
                'direccion'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nombre...']],                    
                'ciudad'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nro Inventario...']],
                'cp'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nombre...']],                    
                'provincia'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nro Inventario...']],
                'pais'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nro Inventario...']],
            ]
        ]);
        
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=> 2,
            'attributes'=>[       // 2 column layout
                'email'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nombre...']],                    
                'sitioWeb'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nro Inventario...']],
            ]
        ]);
        
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=> 2,
            'attributes'=>[       // 2 column layout
                'info'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Nombre...']],                    
                'nuestrasColecciones'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Nro Inventario...']],
            ]
        ]);
        
         echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=> 5,
            'attributes'=>[       // 2 column layout
                'facebook'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nombre...']],                    
                'twitter'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nro Inventario...']],
                'instagram'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nombre...']],                    
                'googleMas'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nro Inventario...']],
                'linkedin'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nro Inventario...']],
            ]
        ]);
    ?>
    
    <?= //$form->field($model, 'imagen')->textInput(['maxlength' => true])
        $form->field($model, 'imagen')->widget(FileInput::classname(), [
            'options'=>['accept'=>'image/*'],
            'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']
        ]]);
    ?>

    <?= $form->field($model, 'mapaLink')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
