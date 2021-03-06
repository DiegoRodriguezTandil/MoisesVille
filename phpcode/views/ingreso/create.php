<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ingreso */

$this->title = Yii::t('app', 'Nuevo Ingreso');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ingresos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingreso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'btnSave' => $btnSave,
        'btnNewObject' => $btnNewObject,
        'btnNewPersona'=> $btnNewPersona,
        'dataObject' => $dataObject,
    ]) ?>

</div>
