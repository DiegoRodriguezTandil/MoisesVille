<?php

use kartik\helpers\Html;
use kartik\helpers\Enum;
use kartik\tabs\TabsX;
use yii\helpers\Url;
use kotchuprik\fotorama\Widget;

/* @var $this yii\web\View */

$this->title = 'Museo Moises Ville';
?>
<div class="site-index">
     <div class="row">
        <div class="col-sm-6"> 
            <div class="jumbotron">
                <?= Html::img(Yii::getAlias('@web').'/images/logo1.jpg', ['width'=>'180px']);?>
                <?= Html::img(Yii::getAlias('@web').'/images/logo2.jpg', ['width'=>'180px']);?>                
                <h3><strong>Museo Histórico Comunal y de la Colonización Judía </strong><br>"Rabino Aarón H. Goldman"</h3>
                <?php
//                if (!Yii::$app->user->isGuest ){
//                    echo Html::jumbotron([
//                        'heading' => 'Museo Moises Ville', 
//                        'body' => 'Museo Histórico Comunal y de la Colonización Judía <br> Rabino A. H. Goldman',
//                        'buttons' => [
//                             [
//                                'label' => 'Agregar Persona',
//                                'icon' => 'user',
//                                'url' => \yii\helpers\Url::to(['/persona/create']),
//                                'type' => Html::TYPE_PRIMARY,
//                                'size' => Html::SIZE_MEDIUM 
//                            ],
//                            [
//                                'label' => 'Agregar Ingreso',
//                                'icon' => 'book',
//                                'url' => \yii\helpers\Url::to(['/ingreso/create']),
//                                'type' => Html::TYPE_PRIMARY,
//                                'size' => Html::SIZE_MEDIUM,
//                                'styles' => 'padding:0;'
//                            ],               
//                            [
//                                'label' => 'Agregar Acervo',
//                                'icon' => 'leaf',
//                                'url' => \yii\helpers\Url::to(['/acervo/create']),
//                                'type' => Html::TYPE_PRIMARY,
//                                'size' => Html::SIZE_MEDIUM 
//                            ],
//                        ]
//                    ]);
//                }
                ?>
            </div>
        </div>
   
        <div class="col-sm-6">

            <div class="fotorama"
                data-width="100%"
                data-ratio="800/600"                
                >
                <?php

                $widget = Widget::begin([
                'version' => '4.5.2',
                'options' => [
                    'nav' => 'thumbs',
                    'autoplay' => 'true',
                    'transition' => 'crossfade'
                ],
                ]);
                echo Html::img(Yii::getAlias('@web').'/images/museo02.jpg');
                echo Html::img(Yii::getAlias('@web').'/images/museo03.jpg');
                echo Html::img(Yii::getAlias('@web').'/images/museo04.jpg');
                echo Html::img(Yii::getAlias('@web').'/images/museo05.jpg');                

                $widget->end();
                ?>
            </div>

            <!--<p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
        </div>
    </div>

    <div class="body-content">

<!--        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>-->

    </div>
</div>
