<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
