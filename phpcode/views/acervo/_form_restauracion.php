<?php

use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acervo-form">     
    <?php 
      
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=> 3,
            'attributes'=>[       // 2 column layout               
                'restauracion'=>['type'=>Form::INPUT_TEXT, 'label'=>'Restauración','options'=>['placeholder'=>'Detalles...']],   
                'fechaInicioRestauracion'=>[
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>kartik\datecontrol\DateControl::className(), 
                        'hint'=>'Ingrese Fecha de Inicio Restauracióna (dd/mm/aaaa)',
                    ],
                    'fechaFinRestauracion'=>[
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>kartik\datecontrol\DateControl::className(), 
                        'hint'=>'Ingrese Fecha del Fin de la Restauracióna (dd/mm/aaaa)',
                    ],
            ]
        ]);
       
    ?>

</div>
