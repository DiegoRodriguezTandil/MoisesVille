<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Organizacion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organizacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    //echo Url::to('@web/uploads/'.$model->imagen);
    echo Html::img('@web/uploads/' . $model['imagen'], ['width' => '100px']);
        
    ?>
        
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'nombre',
            'organizacionTipo_id',
            'telefono',
            'email:email',
//            'info:ntext',
//            'imagen',
//            'sitioWeb',
//            'nuestrasColecciones:ntext',
//            'facebook',
//            'twitter',
//            'instagram',
//            'googleMas',
//            'linkedin',
//            'mapaLink',
//            'pais',
//            'ciudad',
//            'provincia',
//            'direccion',
//            'cp',
        ],
    ]) ?>

</div>
