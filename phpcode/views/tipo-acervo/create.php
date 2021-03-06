<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoAcervo */

$this->title = Yii::t('app', 'Nuevo Tipo Acervo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Acervos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-acervo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
