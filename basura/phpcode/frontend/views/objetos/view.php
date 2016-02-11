<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Objetos */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Objetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'descripcion:ntext',
            'nroInventario',
            'forma',
            'material',
            'colecciones_id',
            'tema_id',
            'tipoAcervo_id',
            'ancho',
            'largo',
            'alto',
            'peso',
            'diametroInterno',
            'diametroExterno',
            'fechaIngreso',
        ],
    ]) ?>

</div>
