<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;



/* @var $this yii\web\View */
/* @var $model app\models\TipoAcervo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Acervos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-acervo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

<!--filter boton componet of yii2-admin-->
      <?php if(Helper::checkRoute('delete')){
            echo Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
            ]);
        }?>

<!--filter boton componet of yii2-admin-->
     <?php if(Helper::checkRoute('delete')){
            echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }?>


    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'descripcion',
            'tipoAcervo_id',
        ],
    ]) ?>

</div>
