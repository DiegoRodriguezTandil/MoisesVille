<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use kartik\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Acervo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acervos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acervo-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php 
        $form = ActiveForm::begin(
            [
                'type'=>ActiveForm::TYPE_VERTICAL,
                'options'=>['enctype'=>'multipart/form-data'],
            ]
        );
        
        if(!empty($model->id)){
            echo $form->field($model, 'id')->hiddenInput()->label(false);            
        }
        
        if(!empty($model->ingreso_id)){
            echo $form->field($model, 'ingreso_id')->hiddenInput()->label(false);            
        }
        
    ?>
    

    <?=  
        TabsX::widget([
            'position' => TabsX::POS_ABOVE,
            'align' => TabsX::ALIGN_LEFT,
            'encodeLabels'=>false,
            'items' => [
                [
                    'label' => 'Información <i class="glyphicon glyphicon-list-alt"></i>',
                    'content' => $this->render('_form', ['model' => $model, 'form' => $form]),
                    'active' => true,
                ],
                
                [
                    'label' => 'Caraterísticas <i class="glyphicon glyphicon-th-list"></i>',
                    'content' => $this->render('_form_detalles', ['model' => $model, 'form' => $form]),
                ],
                
                [
                    'label' => 'Ubicación <i class="glyphicon glyphicon-map-marker"></i>',
                    'content' => $this->render('_form_ubicacion', ['model' => $model, 'form' => $form]),
                ],
                
                [
                    'label' => 'Dimensiones <i class="glyphicon glyphicon-resize-full"></i>',
                    'content' => $this->render('_form_medidas', ['model' => $model, 'form' => $form]),
                ],
                
                [
                    'label' => 'Restauración <i class="glyphicon glyphicon-tint"></i>',
                    'content' => $this->render('_form_restauracion', ['model' => $model, 'form' => $form]),
                ],

                [
                    'label' => 'Imágenes <i class="glyphicon glyphicon-picture"></i>',
                    'content' => $this->render('_formMultimedia', ['model' => $model, 'acervo_id' =>$model->id, 'form' => $form, 'dataProvider' => $dataProvider ]),
                    'options' => ['id' => 'myveryownID'],
                ],
            ],
        ]);
    
        echo Html::hiddenInput('saveClose',0, array('id'=>'saveClose'));
    ?>
    
    <div class="form-group">
        <?= Html::submitInput(
                    $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), 
                    [
                        'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                        'name' => 'saveButton',
                        'id' => 'saveButton',
                        'value' => 'saveButton',
                        'onClick' => "jQuery('#saveClose').val(1);",
                    ]) 
        ?>
        <?php
            if($enableReturn){
                echo Html::submitInput(
                    Yii::t('app', 'Volver al Ingreso'), 
                    [
                        'class' => 'btn btn-primary',
                        'name' => 'returnButton',
                        'id' => 'returnButton',
                        'value' => 'returnButton',
                        'onClick' => "jQuery('#saveClose').val(2);",
                    ]);                 
            }
        ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
