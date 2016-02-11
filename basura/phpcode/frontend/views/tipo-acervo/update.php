<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoAcervo */

$this->title = 'Actualización Tipo Acervo: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Acervo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-acervo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
