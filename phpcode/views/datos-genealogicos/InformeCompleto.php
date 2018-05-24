
<h1> INFORME COMPLETO </h1>
<?php foreach ($documentos as $documento){
    foreach ($documento as $cursor){?>
    <div class="box box-info box-header search_strong" style="padding-top: 0px" >
        <div class="">
            <h3 style="margin-top: 10px"><?php echo  $cursor['nombre']; ?></h3>
        </div>
    </div>
    
<?php } } var_dump($destinatario); var_dump($detalle); ?>