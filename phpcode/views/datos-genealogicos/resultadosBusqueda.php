<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\GridView;
    rmrevin\yii\fontawesome\AssetBundle::register($this);
?>
<?php
        //var_dump($dataProvider['columns']);
        $colums  = $dataProvider['columns'];
        if (!empty($dataProvider['dataProvider']) && !empty($dataProvider['columns'])){
            echo GridView::widget([
                'dataProvider'=> $dataProvider['dataProvider'],
                'columns'=>  [$colums[1],$colums[2],$colums[3],$colums[4],$colums[5]],
            ]);
        
        }else{
            echo 'No se encontraron resultados para la busqueda';
        }
?>