<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClasificacionGenerica */

$this->title = Yii::t('app', 'Create Clasificacion Generica');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clasificacion Genericas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion-generica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
