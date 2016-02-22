<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UnidadMedida */

$this->title = Yii::t('app', 'Create Unidad Medida');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unidad Medidas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidad-medida-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
