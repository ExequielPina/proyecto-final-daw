<?php
// importar conexión
include '../../includes/app.php';
$db = conexionDB();


    // autenticar usuario
    $validacion = [];    
        
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // validar datos
        $email = mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) ); //filter validate valida que sea un email válido

        $password = mysqli_real_escape_string($db,  $_POST['password']);

        if(!$email) {
            $validacion[] = "El email es obligatorio o no es válido";
        }
        if(!$password) {
            $validacion[] = "El passwor es obligatorio o no es válido";
        }
        if(empty($validacion)) {

            //Comprobar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '${email}' ";
        $consulta = mysqli_query($db, $query);

        if( $consulta->num_rows) { // if que comprueba que existan resultados en la consulta 
                    // verificar si la contraseña es correcta
        $usuario = mysqli_fetch_assoc($consulta);

            //comprobar si la contraseña es correcta
            $auth = password_verify($password, $usuario['password']);

            if($auth) {
                    //si la contraseña es correcta
                    session_start();

                        //array de la sesión
                        $_SESSION['usuario'] = $usuario['email'];
                        $_SESSION['login'] = true;
                       // if que re direcciona al usuario si esta autenticado correctamente 
                if($auth) {
                    header('Location: ../index.php?consulta=4');
                }

                } else {
                        $validacion[] = "La contraseña es incorrecta";
                        }

                } else {
                        $validacion[] = "Usuario invalido";
                    }
                }
             

       
    }

    
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>muevetelimpio.com</title>
    <link rel="preload" href="css/normalize.css" as="style">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa&family=Tangerine&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <header class="cabecera">
        <div class="nombre">
            <a href="../index.php">
                <h1  class="nombre">Muevete limpio<span>.com</span></h1>          
            </a>
               
        </div>                   
    </header> 
</div>                            <!--MENU NAVEGACION--> 
    <div class="nav-class">
        <nav class="navegacion contenedor-nav">
                <a href="patinetes.php">Patinetes</a>
                <a href="bicicletas.php">Bicicletas</a>
                <a href="nosotros.php">Nosotros</a>
                <a href="contacto.php">Contacto</a>
        </nav>
    </div>  <!--FIN NAVEGACION-->    


    <main class="contenedor login-main">
    <?php foreach($validacion as $vali): ?>
            <div class="error">
                <?php echo $vali; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario formulario-login">
         <h1>Iniciar sesión</h1>
        
         <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="60" height="60" viewBox="0 0 24 24" stroke-width="1.5" stroke="#7bb111" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <circle cx="12" cy="7" r="4" />
            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
        </svg>
            <legend></legend>
            
            
            <label for="email">E-mail:</label>
            <input type="mail" name="email" placeholder="Tu E-mail" id="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" placeholder="Ingresa tu contraseña" id="contraseña" required>

            <input type="submit" value="Iniciar Sesión" class="btn-sesion">


        </form>
        