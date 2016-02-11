<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

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
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Museo Moises Ville',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Índice', 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                //$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Acceder', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Inventario',
                    'items' => [
                        ['label' => 'Objetos', 'url' => ['/objetos/index']],
                        '<li class="divider"></li>',
                        ['label' => 'Entrada', 'url' => ['/entrada/index']],
                        ['label' => 'Prestamos', 'url' => ['/prestamo/index']],
                        ['label' => 'Bajas', 'url' => ['/baja/index']],
                    ]
                ];
                $menuItems[] = [
                    'label' => 'Árbol Genealógico',
                    'items' => [
                        ['label' => 'Busqueda', 'url' => ['/arbol/index']],
                        ['label' => 'Entrada', 'url' => ['/entrada/index']],
                    ]
                ];
                $menuItems[] = [
                    'label' => 'Sistema',
                    'items' => [
                        ['label' => 'Personas', 'url' => ['/personas/index']],
                        ['label' => 'Colecciones', 'url' => ['/colecciones/index']],
                        ['label' => 'Temas', 'url' => ['/tema/index']],
                        ['label' => 'Ubicaciones', 'url' => ['/ubicaciones/index']],
                        ['label' => 'Tipos Acervo', 'url' => ['/tipo-acervo/index']],                        
                    ]
                ];
                $menuItems[] = [
                    'label' => 'Salir (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            $menuItems[] = [
                'label' => 'Ayuda',
                'items' => [
                    ['label' => 'Acerca de...', 'url' => ['/site/about']],
                    '<li class="divider"></li>',
                    ['label' => 'Contacto', 'url' => ['/site/contact']],
                ]
            ];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
