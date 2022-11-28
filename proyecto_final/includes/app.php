<?php 

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//CONEXIÖN A LA BASE DE DATOS
$db = conexionDB();

use App\Patinete;
use App\Repuesto;

Patinete::setDB($db);
Repuesto::setDB($db);


 