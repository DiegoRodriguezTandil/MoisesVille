<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Objetos */

$this->title = 'Actualizar Objetos: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Objetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="objetos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
