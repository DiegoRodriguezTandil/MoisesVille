<?php
    if (!empty($documentos)){
        foreach ($documentos as $documento){
            echo $documento['nombre'];
            echo $documento['categoria_id'];
        }
    }
?>