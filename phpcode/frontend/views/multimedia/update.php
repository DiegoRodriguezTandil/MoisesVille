<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Multimedia */

$this->title = 'Update Multimedia: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Multimedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'tipoMultimedia_id' => $model->tipoMultimedia_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="multimedia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
