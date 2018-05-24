<?php ?>
<h1> INFORME REDUCIDO </h1>
<?php
    foreach ($documentos as $documento){
        foreach ($documento as $cursor){
    ?>
    
    <div class="box box-info box-header search_strong" style="padding-top: 0px" >
        <div class="">
            <p style="margin-top: 10px">
                <?php
                    $categoria = \app\models\Categoria::find()->where(['id' => $cursor['categoria_id'] ])->one();
                    echo 'Se encontraron datos de '.$cursor['nombre'].' en '.$categoria->descripcion;
                ?>
            </p>
        </div>
    </div>
            
<?php } } var_dump($destinatario); var_dump($detalle) ?>
