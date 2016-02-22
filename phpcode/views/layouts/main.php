<?php

/* @var $this \yii\web\View */
/* @var $content string */

//use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\helpers\Html;
use kartik\popover\PopoverX;
use kartik\nav\NavX;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap_old">
    <?php //$content = '<p class="text-justify">' .
    //'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.' . 
   // '</p>';
    ?>
    <?php /*
    NavBar::begin([
        'brandLabel' => 'Museo Moises Ville',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
          //  ['label' => 'Home', 'url' => ['/site/index']],
          //  ['label' => 'About', 'url' => ['/site/about']],
          //  ['label' => 'Contact', 'url' => ['/site/contact']],    
            ['label' =>  Yii::t('app', 'Inicio'), 'url' => ['/site/index']],
            ['label' => Yii::t('app','Ingreso'), 'url' => ['/ingreso']],
            ['label' => Yii::t('app','Acervo'), 'url' => ['/acervo']],
            ['label' => Yii::t('app','Usuarios'), 'url' => ['/user']],                    
            ['label' => Yii::t('app','Configuración'), 'url' => ['/site/contacto'],
                'items'=>array(
                        array('label'=>'Colecciones', 'url'=>array('/coleccion')),
                        array('label'=>'Temas', 'url'=>array('/tema')),
                        array('label'=>'Tipos de Acervo', 'url'=>array('/tipo-acervo')),
                        array('label'=>'Multimedia', 'url'=>array('/multimedia')),
                      ),
            ],
            ['label' => Yii::t('app','Contacto'), 'url' => ['#']],
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login']] :
                [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
     * 
     */
    ?>
    
    <?php
    $logo = Html::img('@web/moises.png', ['width'=>'300']);
    NavBar::begin([
        'brandLabel' => $logo, //'<img src="' . \Yii::$app->urlManager->createAbsoluteUrl('/web/moises.png') . '" width="100%">',
        'brandUrl' => '#',
        'brandOptions' => ['title' => 'Krajee.com - Web Development Evolved', 'style'=>'width:auto'],
        'options' => [
            'id' => 'top-menu',
            'class' => 'navbar-inverse',
        ],
        'innerContainerOptions' => ['class'=>'kv-container'],
        'renderInnerContainer' => true
    ]);
    $itemsLeft = [
        ['label' => 'Inicio', 'url' => '/'],        
        ['label' => Yii::t('app','Ingreso'), 'url' => ['/ingreso']],
            ['label' => Yii::t('app','Acervo'), 'url' => ['/acervo']],
            ['label' => Yii::t('app','Usuarios'), 'url' => ['/user']],                    
            ['label' => Yii::t('app','Configuración'), 'url' => ['/site/contacto'],
                'items'=>array(
                        array('label'=>'Colecciones', 'url'=>array('/coleccion')),
                        array('label'=>'Temas', 'url'=>array('/tema')),
                        array('label'=>'Tipos de Acervo', 'url'=>array('/tipo-acervo')),
                        array('label'=>'Multimedia', 'url'=>array('/multimedia')),
                      ),
            ],
            ['label' => Yii::t('app','Contacto'), 'url' => ['#']],
    ];
    echo NavX::widget(['options' => ['class' => 'navbar-nav'], 'items' => $itemsLeft]);
    $userPopover = '<li class="dropdown"><div class="navbar-form">' . PopoverX::widget([
        'header' => 'Hello world',
        'placement' => PopoverX::ALIGN_BOTTOM_RIGHT,
        'size' => 'md',
        'content' => $content,
        'footer' => Html::button('Proceed &raquo;', ['class'=>'btn btn-sm btn-default']),
        'toggleButton' => [
            'label' => 'Logout' . Html::tag('span', '', ['class' => 'glyphicon glyphicon-lock', 'style' => 'padding-left: 10px']),
            'class'=>'btn btn-default'
        ]
    ]) . '</div></li>';
    $itemsRight = [
        ['label' => 'Account', 'url' => '#'],
        '<li class="divider-vertical"></li>',
        '<li>' . $userPopover . '</li>'
    ];
    echo NavX::widget(['options' => ['class' => 'navbar-nav navbar-right'], 'items' => $itemsRight]);
    NavBar::end();
    ?>

    <div class="container">
        <div class="col-sm-9">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
        <div class="col-sm-3">
            <p><?php //echo "Mensajes ".Html::badge('15');
                //echo Html::well("Mensajes ".Html::badge('15'), Html::SIZE_TINY);
                ?>
                <button class="btn btn-primary" type="button">
                Mensajes <span class="badge">4</span>
                </button>   
            </p>
            <div class="list-group">
                <a href="#" class="list-group-item disabled">
                  Agregar Componentes
                </a>
                <a href="index.php?r=ingreso/create" class="list-group-item">Nuevo Ingreso</a>
                <a href="index.php?r=tema/create" class="list-group-item">Nuevo Tema</a>
                <a href="index.php?r=coleccion/create" class="list-group-item">Nueva Colección</a>
                <a href="index.php?r=tipo-acervo/create" class="list-group-item">Nuevo Tipo de Acervo</a>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Moises Ville Museo <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
