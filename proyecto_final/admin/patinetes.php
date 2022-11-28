<?php 
    session_start();
    $auth = $_SESSION['login'];

    if(!$auth) {
        header('Location: patinetes/login.php');
    }


    // Muestra mensaje condicional recogido por GET (actualizado, eliminado o creado)
    $consulta = $_GET['consulta'] ?? null; 
 
        
    // IMPORTAR LA CONEXIÓN
    include '../includes/app.php';
    $db = conexionDB();

    // QUERY 
    $query = "SELECT * FROM patinetes";
    

    // CONSULTA A LA BBDD
    $consultaDb = mysqli_query($db, $query);

            //ELIMINAR PRODUCTO
    // Recogemos el id del formulario a través del método POST
    if($_SERVER ['REQUEST_METHOD'] ==='POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {

            // eliminar foto de los archivos
            $query = "SELECT imagen FROM patinetes WHERE id = ${id}";

           $consulta = mysqli_query($db, $query);
           $img_delete =  mysqli_fetch_assoc($consulta);

           unlink('../imagenes/' . $img_delete['imagen']);
           



            // query que elimina producto
            $query = "DELETE FROM patinetes WHERE id = ${id}";
            $consulta = mysqli_query($db, $query);

            if($consulta) {
                header('Location: patinetes.php?consulta=3');
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
    <link rel="stylesheet" href="../css/styles.css">
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
                        <?php if($auth): ?>
                            <a href="../admin/patinetes/cerrar-sesion.php">Cerrar sesión<p>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="52" height="52" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                    <path d="M7 12h14l-3 -3m0 6l3 -3" />
                                </svg></p></a>
                        <?php endif; ?>
                    </nav>
                </div>  <!--FIN NAVEGACION-->     
               
<main class="contenedor-panel">
    
    <h1>Todos los patinetes</h1>
    <div class="contenedor contenedor-icon">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tool" width="68" height="68" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5" />
</svg>
    </div>
    <?php if(intval( $consulta ) === 1): ?>
        <p class="mensaje">Producto creado correctamente!!</p>
    <?php elseif (intval( $consulta ) === 2) :?> 
        <p class="mensaje">Producto actualizado correctamente!!</p>
    <?php elseif (intval( $consulta ) === 3) :?> 
        <p class="mensaje">Producto eliminado correctamente!!</p>  
    <?php elseif (intval( $consulta ) === 4) :?> 
        <p class="mensaje">Sesión iniciada correctamente
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-check user-ok" width="60" height="60" viewBox="0 0 24 24" stroke-width="1.5" stroke="#7bb111" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <circle cx="9" cy="7" r="4" />
                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                <path d="M16 11l2 2l4 -4" />
            </svg>
        </p>        
    <?php  endif; ?>
 
    <div class="nav-class">
                    <nav class="navegacion contenedor-nav">
                        
                        <a href="patinetes/crear.php">Crear patinete</a>
                        <a href="repuestos.php">Repuestos y recambios</a>
                        <a href="patinetes/crear-repuesto.php">Crear repuesto</a>
                    </nav>
    </div>  <!--FIN NAVEGACION-->  

    <div class="contenedor tableClass">
        <table class="tabla-productos">
            <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Características</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Potencia</th>
                <th>Velocidad</th>
                <th>Fecha de creación</th>
            </tr>
            </thead>

            <tbody> <!--Listar los productos-->
                <?php while( $patinetes = mysqli_fetch_assoc($consultaDb)): ?>
                <tr>
                    <td><?php echo $patinetes['id']; ?></td>
                    <td><?php echo $patinetes['marca']; ?></td>
                    <td><?php echo $patinetes['modelo']; ?></td>
                    <td><?php echo $patinetes['caracteristicas']; ?></td>
                    <td><?php echo $patinetes['precio']; ?>€</td>
                    <td><img src="../imagenes/<?php echo $patinetes['imagen']; ?>" class="img-tabla"> </td>
                    <td><?php echo $patinetes['potencia']; ?>W</td>
                    <td><?php echo $patinetes['velocidad']; ?>Km/h</td>
                    <td><?php echo $patinetes['fecha']; ?></td>

                    <td>
                        <form method="POST" class="eliminar-form">
                            <input type="hidden" name="id" value="<?php echo $patinetes['id'] ?>">
                            <input type="submit" class="btn-eliminar" value="Eliminar">
                        </form>             
                        <a href="patinetes/actualizar.php?id=<?php echo $patinetes['id']; ?>" class="btn-act">Editar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            
        </table>
    </div>
  

    

</main>

<!--CERRAR CONEXIÓN A LA BBDD-->
<?php mysqli_close($db) ?>

               
                <footer class="footer footer-seccion">
                    <p>Todos los derechos reservados <?php echo date('Y') ?> &copy;</p>
                </footer>
    
    <script src=""></script>
</body>

</html>