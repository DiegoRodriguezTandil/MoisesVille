<table>
    <tr>
        <td rowspan="2"><img src="https://pbs.twimg.com/profile_images/426830586905239552/8U_yf8FI_400x400.png" width="100" alt=""></td>
        <td> <strong> Museo Histórico Comunal y de la Colonización Judía  <br> "Rabino A. H. Goldman" - Moises Ville </strong> </td>
    </tr>
</table>
<h3> Informe Completo </h3>
<hr>
<?php foreach ($documentos as $documento){
    foreach ($documento as $cursor){?>
    <div class="box box-info box-header search_strong" style="padding-top: 0px" >
        <div class="">
            <h4 style="margin-top: 10px"><?php echo 'Nombre: '.$cursor['nombre']; ?></h4>
            <p> <?php echo ucwords($cursor['detalleFull']);  ?> </p>
        </div>
    </div>
    
<?php } } ?>
<p> <?php if (!empty($detalle)){ echo "Notas".$detalle;} ?>   </p>

