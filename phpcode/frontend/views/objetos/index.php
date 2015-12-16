<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ObjetosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Objetos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Objetos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            'descripcion:ntext',
            'nroInventario',
            'forma',
            // 'material',
            // 'colecciones_id',
            // 'tema_id',
            // 'tipoAcervo_id',
            // 'ancho',
            // 'largo',
            // 'alto',
            // 'peso',
            // 'diametroInterno',
            // 'diametroExterno',
            // 'fechaIngreso',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
