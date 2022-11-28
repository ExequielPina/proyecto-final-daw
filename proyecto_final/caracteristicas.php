<?php

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    

    if(!$id) {
        header('Location: index.php');
    }

      // Importar la conexión 
      require 'includes/app.php';
      $db = conexionDB();
     
      // consulta a la bbdd
      
      $query = "SELECT * FROM patinetes WHERE id = ${id}";
  
      // Obtener resultados
      $consulta = mysqli_query($db, $query);

      //if que comprueba que existan resultados y si no los hay, Re direcciona al index
      if(!$consulta->num_rows) {
        header('Location: index.php');
      }
      $caracteristicas = mysqli_fetch_assoc($consulta);

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
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="cabecera">
        <div class="nombre">
            <a href="index.php">
                <h1  class="nombre">Muevete limpio<span>.com</span></h1> 
            </a>
               
        </div>                   
    </header> 
</div>                            <!--MENU NAVEGACION--> 
                <div class="nav-class">
                    <nav class="navegacion contenedor-nav">
                        <a href="patinetes.php">Patinetes</a>
                        <a href="repuestos.php">Repuestos</a>
                        <a href="nosotros.php">Nosotros</a>
                        <a href="contacto.php">Contacto</a>
                    </nav>
                </div>  <!--FIN NAVEGACION-->     

    <section class="section productos caract-producto">
                
                <div class="contenedor2 contenedor-productos2">  
                <h1>Detalles del producto</h1>
                    <div class="producto">
                        
                        <img loading="lazy" class="iss2" src="imagenes/<?php echo$caracteristicas['imagen']; ?>" alt="patinete">
                        <div class="contenido-producto">
                            <h3><?php echo $caracteristicas['marca']; ?> </h3>
                            <h3>Modelo: <?php echo $caracteristicas['modelo']; ?></h3>
                            <p>Caracteristicas: <?php echo $caracteristicas['caracteristicas']; ?></p>
                            <p class="precio"> <?php echo $caracteristicas['precio']; ?>€</p>
                            <ul class="iconos-producto">
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-battery-4" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M6 7h11a2 2 0 0 1 2 2v.5a0.5 .5 0 0 0 .5 .5a0.5 .5 0 0 1 .5 .5v3a0.5 .5 0 0 1 -.5 .5a0.5 .5 0 0 0 -.5 .5v.5a2 2 0 0 1 -2 2h-11a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2" />
                                        <line x1="7" y1="10" x2="7" y2="14" />
                                        <line x1="10" y1="10" x2="10" y2="14" />
                                        <line x1="13" y1="10" x2="13" y2="14" />
                                        <line x1="16" y1="10" x2="16" y2="14" />
                                    </svg>
                                    <p><?php echo $caracteristicas['potencia']; ?>W</p>
                                </li>

                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dashboard" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <circle cx="12" cy="13" r="2" />
                                        <line x1="13.45" y1="11.55" x2="15.5" y2="9.5" />
                                        <path d="M6.4 20a9 9 0 1 1 11.2 0z" />
                                    </svg>
                                    <p><?php echo $caracteristicas['velocidad']; ?>Km/h</p>
                                </li>
                            </ul>
                            <a href="index.php"  class="boton boton-producto">Volver</a>                     
                        </div>
                    </div> 
                                         
                </div>
    </section>

<?php include 'includes/templates/footer.php' ?>
<?php mysqli_close($db);?> 
