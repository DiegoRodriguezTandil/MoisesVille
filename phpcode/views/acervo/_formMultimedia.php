<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm; // or yii\widgets\ActiveForm
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;

?>

<div class="multimedia-form">
    <div class="row">
        <div class="col-sm-4">   
        <?php 
    //        echo $form->field($model, 'files[]')->widget(FileInput::classname(), [
    //            'options'=>['multiple' => true, 'accept'=>'image/*', 'label'=>'Fotos'],
    //            'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],
    //                'label'=>'Fotos'
    //        ]]);

            // With model & without ActiveForm
            echo '<label class="control-label">Agregar Fotos</label>';
            echo FileInput::widget([
                'model' => $model,
                'attribute' => 'files[]',
                'options' => ['multiple' => true,
                'accept'=>'image/*'],
                'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],
                ]]);
        ?>

        <?php  
            echo Html::hiddenInput('Multimedia[objeto_id]',$acervo_id);  
            echo Html::hiddenInput('multimedia','si');  
            echo Html::hiddenInput('objeto_id',$acervo_id);          


        ?>
        </div>
        <div class="col-sm-8">   
            <h3>Imágenes del Objeto</h3>
            <div class="fotorama"
                data-width="100%"
                data-ratio="800/600"
                data-minwidth="400"
                data-maxwidth="1000"
                data-minheight="600"
                data-maxheight="100%">
                <?php

                $widget = \kotchuprik\fotorama\Widget::begin([
                'version' => '4.5.2',
                'options' => [
                    'nav' => 'thumbs',
                ],
                ]);

                foreach($dataProvider->getModels() as $img)   
                     echo Html::img( '@web' .$img->webPath);

                $widget->end();
                ?>
            </div>
        </div>
    </div>
</div>
