<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ubicacion Externas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubicacion-externa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ubicacion Externa'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
            <?php 
            Modal::begin([
            'id' => 'myModal',
            'toggleButton' => [
                'label' => '<i class="glyphicon glyphicon-plus"></i> Agregar Ubicación',
                'class' => 'btn btn-success'
            ],
            'closeButton' => [
              'label' => 'Close',
              'class' => 'btn btn-danger btn-sm pull-right',
            ],
            'size' => 'modal-lg',
        ]);
        $class_Ubic = 'app\models\UbicacionExterna';
        $UEModel = new $class_Ubic();

        echo $this->render('/ubicacion-externa/create', ['model' => $UEModel]);
        Modal::end();
        ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fechaInicio',
            'fechaCierre',
            'ubicacion',
            'acervo_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
