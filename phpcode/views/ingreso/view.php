<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Ingreso */

$this->title = 'Ingreso ID Nº '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ingresos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingreso-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
     

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'descripcion',
            'fechaEntrada',
            'observaciones',
            'fechaBaja',
            'personaName',
            'userName',
        ],
    ]) ?>
    
    <h2>Objetos del Ingreso</h2>
    
    <?= GridView::widget([
            'dataProvider' => $acervos,
            'columns' => [
                'nombre',
                'nroInventario',
            ],
        ]);
    ?>
    
    

</div>
