<?php

if (!empty($mongoDocument)){
    foreach ($mongoDocument as $document){
       echo "<h3 style='margin-top: 0px;margin-bottom: 0px;'>".$document['nombre']."</h3>";
       echo $document['detalle'];
    }
}

?>



