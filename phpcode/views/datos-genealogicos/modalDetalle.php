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



