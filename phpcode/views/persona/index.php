<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Personas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
    <!--HELPER YII2-ADMIN-->
       <?php if(Helper::checkRoute('create')){
            echo Html::a(Yii::t('app','Crear Persona'),['create'], ['class' => 'btn btn-success']);
        }?>

</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'nombre',
            'apellido',
            'mail',
//            'fechaNacimiento',
            // 'domicilio',
            // 'telefono',
            // 'localidad_id',

            [
        'class' => 'yii\grid\ActionColumn',
        'template' => Helper::filterActionColumn('{view}{delete}{update}'),
    ]
        ],
    ]); ?>

</div>



