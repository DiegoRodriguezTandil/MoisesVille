<?php
use kotchuprik\fotorama;
use yii\helpers\Html;
//use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\helpers\Url;
use kartik\detail\DetailView;
use bupy7\gridifyview\GridifyView;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Acervo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acervos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acervo-view" id="top">

    <div style="width:1000px; float:left; font-size: 14px;  border-style: solid;
    border-bottom: dotted #000;">
        <div style="width:200px; float:left;">
            <p>N° de Registro</p><?=$model->nroInventario;?>
        </div>
        <div style="float:left; width:300px; text-align:center;">
            <h4>Museo Histórico Comunal <br>y de la colonización judía<br>"Rabino Aarón N. Goldman"</h4>            
        </div>
        <div style="width:100px; float:right;">
            <p>N° de Orden</p><?=$model->id;?>
        </div>
    </div>
    
    <div style="width:1000px; margin-top:10px;float:left; font-size: 14px; ">
        <div style="width:400px; float:left;">
            <p><strong>Designación:</strong> <?=$model->nombre;?> </p>
        </div>
        <div style="float:left; text-align:center;">
            <p><strong>Clasificación Genérica: </strong><?=$model->clasificacionGenerica->nombre;?></p>
        </div>       
    </div>
    
    <div style="width:1000px; float:left; font-size: 14px; ">
        <div style="width:400px; float:left;">
            <p><strong>Modo de Adquisición: </strong> </p>
        </div>
        <div style="float:left; text-align:center;">
            <p><strong>Fecha ingreso: </strong><?=$model->fechaIngreso;?></p>
        </div>       
    </div>
    
    <div style="width:1000px; float:left; font-size: 14px;">
        <div style="float:left;">
            <p><strong>Nombre del donante/colector/propietario/artesano: </strong></p>
        </div> 
        <div style="float:left;  border-style: solid; border-bottom: thin #000; margin-bottom: 10px;">
            <p><strong>Material: </strong><?=$model->material;?></p>
        </div>             
    </div>  
    
    <div style="width:1000px; float:left; font-size: 14px; margin-bottom: 10px;">
        <div style="float:left; width: 150px;"><strong>Dimensiones</strong></div>
        <div style="float:left; width: 150px;">
           <strong> Ancho: </strong> <?=$model->ancho;?>
        </div> 
        <div style="float:left; width: 100px;">
            <strong>Alto: </strong> <?=$model->alto;?> 
        </div> 
        <div style="float:left;">
            <strong>Profundidad:</strong> <?=$model->alto;?>
        </div>             
    </div> 
    
    <div style="width:1000px; float:left; font-size: 14px; margin-bottom: 10px;">
        <div style="float:left; width: 150px;">
            <strong>Forma: </strong> <?=$model->forma;?>
        </div> 
        <div style="float:left; width: 150px;">
            <strong>Peso: </strong> <?=$model->peso;?> 
        </div> 
        <div style="float:left;">
            <strong>Color: </strong><?=$model->color;?>
        </div>             
    </div>
      
    <div style="width:1000px; float:left; font-size: 14px; margin-bottom: 10px; border-style: solid; border-bottom: thin #000;">
        <div style="float:left; width: 150px;"><strong>Características</strong></div>
        <div style="float:left;margin-bottom: 20px; ">
            <?=$model->caracteristicas;?>
        </div> 
    </div>
    
    <div style="width:1000px; float:left; font-size: 14px; margin-bottom: 10px;">
        <div style="float:left; width: 400px;">
            <strong>Descripción Época: </strong> <?=$model->descEpoca;?>
        </div> 
        <div style="float:left; ">
            <strong>Lugar de Procedencia: </strong> <?=$model->lugarprocac;?> 
        </div>                 
    </div>
    <div style="width:1000px; float:left; font-size: 14px; margin-bottom: 10px;">
        <div style="float:left; width: 150px;"><strong>Restauración</strong>        
            <?=$model->restauracion;?>
        </div> 
    </div>
    
    <div style="width:1000px; float:left; font-size: 14px; margin-bottom: 10px; border-style: solid; border-bottom: thin #000;">
        <div style="float:left; width: 150px; margin-bottom: 10px; "><strong>Observaciones</strong></div>
        <div style="float:left;margin-bottom: 20px; ">
            <?=$model->notas;?>
        </div> 
    </div> 
    
    <div style="float:left; font-size: 14px; margin: 10px;  ">
        <strong>Fotografías:</strong>        
        <?php foreach($dataProvider->getModels() as $img) {  ?>
                <div style="width:400px; float:left; font-size: 14px; margin: 10px;  ">
                    <?php   echo Html::img( '@web' .$img->webPath); 
                            echo '</div>';
             } ?>
                    
    </div>
        
    <div style="width:1000px; float:left; font-size: 14px; margin-bottom: 10px;">
        <div style="float:left; width: 400px;"><br>
            <strong>Firma: </strong>
        </div> 
        <div style="float:left; width: 200px;">
            <strong>Fecha: ......../......../........
        </div>                 
    </div>
   
</div>
