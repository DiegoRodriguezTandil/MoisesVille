<?php
    $js = <<<JS
        
        $('#closeModal').click(function() {
            $('#modal').modal('toggle');
        });
JS;
    $this->registerJs($js);
?>
<div>
    <div class="">
        <?php
        
            if (!empty($mongoDocument)){
                foreach ($mongoDocument as $document){
                    if (array_key_exists('nombre',$document))
                        echo "<h3 style='margin-top: 0px;margin-bottom: 0px;'>".$document['nombre']."</h3>";
                    if (array_key_exists('detalleFull',$document))
                        echo $document['detalleFull'];
                    elseif (array_key_exists('detalle',$document))
                        echo $document['detalle'];
                }
            }
        ?>
    </div>
    <div class="row">
        <div class="col-xs-10"></div>
        <div class="col-xs-2">
            <div class="row">
                <button id="closeModal" type="button" class="btn btn-danger">Cerrar</button>
            </div>
        </div>
    </div>
    
</div>



