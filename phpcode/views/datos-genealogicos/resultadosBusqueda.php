<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\GridView;
    rmrevin\yii\fontawesome\AssetBundle::register($this);
?>
<?php
        if (!empty($dataProvider)){
            echo GridView::widget([
                'dataProvider'=> $dataProvider['dataProvider'],
                'columns'=>  $dataProvider['columns'],
            ]);
        
        }else{
            echo 'No se encontraron resultados para la busqueda';
        }
       
       
       
      
    
    ?>