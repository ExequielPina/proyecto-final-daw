<?php

function conexionDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'root', 'muevete_limpio');

    if(!$db){
        echo "Error de conexión";
        exit;
    }    
    return $db;
}