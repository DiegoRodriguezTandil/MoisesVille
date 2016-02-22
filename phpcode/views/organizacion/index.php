<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrganizacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Organizacions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Organizacion'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'organizacionTipo_id',
            'telefono',
            'email:email',
            // 'info:ntext',
            // 'imagen',
            // 'sitioWeb',
            // 'nuestrasColecciones:ntext',
            // 'facebook',
            // 'twitter',
            // 'instagram',
            // 'googleMas',
            // 'linkedin',
            // 'mapaLink',
            // 'pais',
            // 'ciudad',
            // 'provincia',
            // 'direccion',
            // 'cp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
