<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;
use yii\helpers\Url;
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
            ['type'=>ActiveForm::TYPE_VERTICAL]
        );
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
                    'label' => 'Imágenes <i class="glyphicon glyphicon-picture"></i>',
                    'content' => $this->render('_formMultimedia', ['model' => $model, 'acervo_id' =>$model->id, 'form' => $form ]),
                    'options' => ['id' => 'myveryownID'],
                ],
            ],
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
