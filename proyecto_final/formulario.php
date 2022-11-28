<?php


// RECOGIDA DE DATOS DEL FORMULARIO
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];
$opciones = $_POST['opciones'];
$precio = $_POST['precio'];
$contacto = $_POST['contacto'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

// Datos del correo
$destinatario = "exequiel_pina@hotmail.es";
$asunto = "oferta muevetelimpio.com";

$correo = "De: $nombre \n";
$correo .= "Email: $email \n";
$correo .= "Telefono: $telefono \n";
$correo .= "mensaje: $mensaje \n";
$correo .= "Opcion: $opciones \n";
$correo .= "Precio: $precio \n";
$correo .= "Contacto: $contacto \n";
$correo .= "fecha: $fecha \n";
$correo .= "Hora: $hora";

mail($destinatario, $asunto, $correo);


if($_POST) {
    header('Location: contacto.php?consulta=1');
 }
 


?>
