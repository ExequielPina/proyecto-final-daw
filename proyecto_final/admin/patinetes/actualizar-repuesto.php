<?php 

//if que comprueba si la sesión esta creada 
session_start();
$auth = $_SESSION['login'];

if(!$auth) {
    header('Location: login.php');
}

//importar conexión a la bbdd
include '../../includes/app.php';

// Recogemos el ID del producto por actualizar a través de GET, para  auto-llenar los datos del form
$id = $_GET['id'];
$db = conexionDB();

// Obtener los datos del producto
$consulta = "SELECT * FROM  repuestos WHERE id = ${id}";
$resultado = mysqli_query($db, $consulta);
$productoId = mysqli_fetch_assoc($resultado); // Uso mysqli_fetch_assoc ya que solo hay que iterar 1 resultado 

// Validación que evita que no se pasen otros datos por la URL
$id = filter_var($id, FILTER_VALIDATE_INT); 

if(!$id) {
    header('Location:../index.php');
}

$db = conexionDB();

    // Validación del formulario
    $validacion = [];

    // array vacío que almacena los datos del formulario para no tener volver a rellenar los campos en caso de error al completar el formulario. (se almacena en el value del form)
    $marca = $productoId['marca'];
    $caracteristicas = $productoId['caracteristicas'];
    $precio = $productoId['precio'];
    $nombre = $productoId['nombre'];
    $imagen = $productoId['imagen'];
    

  // Almacenamos datos provenientes de POST
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // La funcion mysqli_real_escape_string Evita inyección SQL 
    $marca = mysqli_real_escape_string( $db, $_POST['marca'] );
    $caracteristicas = mysqli_real_escape_string( $db, $_POST['caracteristicas'] );
    $precio = mysqli_real_escape_string( $db, $_POST['precio'] );
    $nombre = mysqli_real_escape_string( $db, $_POST['nombre'] );
    $fecha = date('Y/m/d');
    $imagen = $_FILES['imagen'];


    // if de comprobación
    if(!$marca) {
        $validacion[] = "La marca es obligatoria!!";    
    }
  
    if(!$caracteristicas) {
        $validacion[] = "Las características son obligatorias!!";    
    }
    if(!$precio) {
        $validacion[] = "El precio es obligatorio!!";    
    }
  
    if(!$nombre) {
        $validacion[] = "El nombre es obligatorio!!";    
    }
    
    // validacion por tamaño de la imagen (máximo 2 megas)
    $tamaño = 1000 * 1000;
    if($imagen['size'] > $tamaño) {
        $validacion[] = 'EL tamaño de la imagen no deber ser superior a 1 mega';
    }
 

    // validación con la función empty que comprueba que el array no venga vacío  
    if(empty($validacion)) {
        
        /**IDENTIFICAMOS DONDE SE ALMACENAN LAS IMAGENES Y SI SE SUBE UNA NUEVA, SE BORRA LA ANTERIOR */
        $carpeta_imagenes = '../../imagenes/';

        if(!is_dir($carpeta_imagenes)) {
            mkdir($carpeta_imagenes);
        }
        $nombre_unico = '';

        if($imagen['name']) {
            // Eliminar la imagen anterior
            unlink($carpeta_imagenes . $productoId['imagen']);

               /**GENERAR UN NOMBRE UNICO PARA LAS IMAGENES*/
        $nombre_unico = md5( uniqid( rand(), true) ) . "jpg";

        /**SUBIR IMAGE*/
        move_uploaded_file($imagen['tmp_name'], $carpeta_imagenes . $nombre_unico );
        } else { // else que comprueba que si no se subió otra imagen, mantenga la anterior
            $nombre_unico = $productoId['imagen'];
        }

     
        
        // Inserción en la BBDD
        $query = "UPDATE repuestos 
        SET marca = '${marca}', caracteristicas = '${caracteristicas}',
        precio = ${precio}, imagen = '${nombre_unico}', nombre = '${nombre}' WHERE id = ${id} ";
        
        $consulta = mysqli_query($db, $query);
       

        // if que re direcciona al usuario si el formulario se completó correctamente
        if($consulta) {
            header('Location:../repuestos.php?consulta=2');
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
                <div class="contenedor contenedor-icon-index">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-exclamation" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <circle cx="9" cy="7" r="4" />
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        <line x1="19" y1="7" x2="19" y2="10" />
                        <line x1="19" y1="14" x2="19" y2="14.01" />
                    </svg>
                </div>
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

<main class="contenedor-panel">
    <h1>Panel de cotrol</h1>
</main>

<section class="section-admin">
    <div>
        <h1>Editar recambio</h1>
        <div class="contenedor contenedor-icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="100" height="100" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                <line x1="16" y1="5" x2="19" y2="8" />
            </svg>
        </div>
   
        <div class="boton-panel-cont">
        <a href="../index.php" class="boton-panel">Volver</a>
        </div>
        <!--FOREACH QUE MUESTRA ERRORES EN PANTALLA--> 
        <?php foreach($validacion as $vali): ?>
            <div class="error">
                <?php echo $vali ?>
            </div>
         <?php endforeach; ?> 

            <!--INICIO DEL FORMULARIO--> 
            <form class="formulario" method="POST"  enctype="multipart/form-data">
                <fieldset>
                    <legend>Recambio</legend>

                        <label for="marca">Marca:</label>
                        <input type="text" id="marca" name="marca" placeholder="Marca" value="<?php echo $marca; ?>">
                        
                        </fieldset>

                        <fieldset>
                        <legend>Información del producto</legend>

                        <label for="caracteristicas">Características:</label>
                        <textarea id="caracteristicas" name="caracteristicas"><?php echo $caracteristicas; ?></textarea>

                        <label for="precio">Precio:</label>
                        <input type="number" id="precio" name="precio" placeholder="Precio" value="<?php echo $precio; ?>">

                        <img src="../../imagenes/<?php echo $imagen ?>" class="img-editar">

                        <label for="imagen">Imagen:</label>
                        <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" min="10" max="100" value="<?php echo $nombre; ?>">                    

                        <input type="submit" value="Actualizar" class="boton-panel1">        
                </fieldset>              
             </form><!--FIN DEL FORMULARIO--> 
    </div>
</section>

     
        

                 <!--INICIO DEL FOOTER--> 
                <footer class="footer footer-seccion">
                    <div class="contenedor contenedor-footer">
                        <nav class="navegacion">
                            <a href="patinetes.php">Patinetes</a>
                            <a href="bicicletas.php">Bicicletas</a>
                            <a href="nosotros.php">Nosotros</a>
                            <a href="contacto.php">Contacto</a>
                        </nav>
                    </div>

                    <p>Todos los derechos reservados <?php echo date('Y') ?> &copy;</p>
                </footer>
    
    <script src=""></script>
</body>
</html>