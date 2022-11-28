<?php


// IMPORTAR LA CONEXIÖN
require 'includes/app.php';

$db = conexionDB();

// CREAR EMAIL Y PASSWORD PARA EL USUARIO
$email = "email@email.com";
$password = "123456";

//ENCRIPTAR PASSWORD
$passwordHash = password_hash($password, PASSWORD_BCRYPT);


//INSER DE LOS USUARIOS A LA BBDD
$query = "INSERT INTO usuarios (email, password) VALUES ( '${email}', '${passwordHash}'); ";

echo $query;

mysqli_query($db, $query);






?>