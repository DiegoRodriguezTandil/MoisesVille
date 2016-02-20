<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IngresoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ingresos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingreso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ingreso'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'descripcion',
            'fechaEntrada',
            [
                'attribute' => 'fechaEntrada',
                'value' => 'fechaEntrada',
                'format' => 'raw',
                'options' => ['style' => 'width: 25%;'],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'fechaEntrada',
                    'options' => ['placeholder' => ''],
                    'pluginOptions' => [
                        'id' => 'fechaEntrada2',
                        'autoclose'=>true,
                        'format' => 'dd/mm/yyyy',
                        'startView' => 'year',
                    ]
                ])
            ],            
            'observaciones',
            'fechaBaja',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
