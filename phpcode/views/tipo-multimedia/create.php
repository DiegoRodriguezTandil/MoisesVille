<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoMultimedia */

$this->title = Yii::t('app', 'Nuevo Tipo Multimedia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Multimedia'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-multimedia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
