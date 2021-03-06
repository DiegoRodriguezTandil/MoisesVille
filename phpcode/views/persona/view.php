<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */

$this->title = $model->nombre.' '.$model->apellido;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

<!--filter boton componet of yii2-admin-->
      <?php if(Helper::checkRoute('delete')){
            echo Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
            ]);
        }?>

<!--filter boton componet of yii2-admin-->
     <?php if(Helper::checkRoute('delete')){
            echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }?>


      
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'apellido',
            'mail',
            'fechaNacimiento',
            'domicilio',
            'telefono',
            'localidadName',
        ],
    ]) ?>
    
    <h2>Objetos del Ingreso</h2>
    
    <?= \yii\grid\GridView::widget([
            'dataProvider' => $acervos,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                'nombre',
                'nroInventario',
                [
                    'value'=>'ingreso.descripcion',
                    'header'=>'Ingreso - Descripción'
                ],
                [
                    'value'=>'ingreso.fechaEntrada',
                    'header'=>'Ingreso - Fecha Entrada'
                ]
                
            ],
        ]);
    ?>
    

</div>
