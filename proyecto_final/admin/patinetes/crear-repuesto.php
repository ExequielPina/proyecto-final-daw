<?php
//importar conexión a la bbdd
include '../../includes/app.php';

use App\Repuesto;
use Intervention\Image\ImageManagerStatic as Image;

//if que comprueba si la sesión esta creada 
session_start();
$auth = $_SESSION['login'];

if(!$auth) {
    header('Location: login.php');
}

$db = conexionDB();

    // Validación del formulario
    $validacion = Repuesto::getErrores();

    // array vacío que almacena los datos del formulario para no tener volver a rellenar los campos en caso de error al completar el formulario. (se almacena en el value del form)
    $marca = '';
    $caracteristicas = '';
    $precio = '';
    $nombre = '';
   
    

  // Almacenamos datos provenientes de POST
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    /* SE CREA UNA NUEVA INSTANCIA */
    $repuestos = new Repuesto($_POST);

         /**  SUBIDA DE IMÁGENES  **/
       
         /**GENERAR UN NOMBRE UNICO PARA LAS IMAGENES*/
         $nombre_unico = md5( uniqid( rand(), true) ) . "jpg";    
     
    //REALIZA UN RESIZE A LA IMAGEN
    if($_FILES['imagen']['tmp_name']) {
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(900,700); // Se aplica una dimensión máxima a las imágenes de 800x600  
        $repuestos->setImagen($nombre_unico);
    }
    
    // VALIDAR
    $validacion = $repuestos ->validar();
   
    // validación con la función empty que comprueba que el array no venga vacío  
    if(empty($validacion)) {      
       
        // CREA LA CARPETA DE IMÁGENES SI NO EXISTE 
        if(!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }
                     
        /**GUARDA LA IMÁGEN EN EL SERVIDOR**/
        $image->save(CARPETA_IMAGENES . $nombre_unico);

        // ** guarda en la base de datos **//
        $resultado = $repuestos->guardar();
       
        // if que re direcciona al usuario si el formulario se completó correctamente // tambien arroja un mensaje 
        if($resultado) {
           header('Location: ../repuestos.php?consulta=1');
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
</div>     
<nav class="navegacion contenedor-nav">
                        
                        <a href="../patinetes.php">Patinetes</a>
                        <a href="../repuestos.php">Repuestos y recambios</a>
                        <a href="crear.php">Crear Patinete</a>
                    </nav>                       
      

<main class="contenedor-panel">
    <h1>Panel de cotrol</h1>
</main>

<section class="section-admin">
    <div>
        <h1>Crear repuesto o recambio</h1>
        <div class="contenedor contenedor-icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="100" height="100" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                <circle cx="12" cy="12" r="3" />
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
            <form class="formulario" method="POST" action="crear-repuesto.php" enctype="multipart/form-data">
                <fieldset>
                    <legend>Repuestos y recambios</legend>

                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>">


                        <label for="marca">Marca:</label>
                        <input type="text" id="marca" name="marca" placeholder="Marca" value="<?php echo $marca; ?>">
                        
                        </fieldset>

                        <fieldset>
                        <legend>Información del producto</legend>

                        <label for="caracteristicas">Características:</label>
                        <textarea id="caracteristicas" name="caracteristicas"><?php echo $caracteristicas; ?></textarea>

                        <label for="precio">Precio:</label>
                        <input type="number" id="precio" name="precio" placeholder="Precio" value="<?php echo $precio; ?>">

                        <label for="imagen">Imagen:</label>
                        <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                                           

                        <input type="submit" value="Crear repuesto" class="boton-panel1">        
                </fieldset>              
             </form><!--FIN DEL FORMULARIO--> 
    </div>
</section>

     
        

                 <!--INICIO DEL FOOTER--> 
                <footer class="footer footer-seccion">
                    <p>Todos los derechos reservados <?php echo date('Y') ?> &copy;</p>
                </footer>
    
    <script src=""></script>
</body>
</html>