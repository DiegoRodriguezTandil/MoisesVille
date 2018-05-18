<?php
        
        if (!empty($cursor)){
            foreach ($cursor as $dato){
                if  (empty($dato)) {
                    echo 'No se encontraron resultados para la busqueda';
                }else{
                    var_dump($dato);
                }
            }
        }else{
            echo $mensaje;
        }
      
    
    ?>