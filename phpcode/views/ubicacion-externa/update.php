<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UbicacionExterna */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ubicacion Externa',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ubicacion Externas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ubicacion-externa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
