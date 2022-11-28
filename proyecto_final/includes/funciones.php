<?php 

define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function debug($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}