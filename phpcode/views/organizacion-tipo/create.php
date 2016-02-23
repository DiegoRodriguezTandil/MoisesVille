<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrganizacionTipo */

$this->title = Yii::t('app', 'Create Organizacion Tipo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organizacion Tipos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizacion-tipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
