<?php include 'includes/templates/header.php' ?>

<?php
    // Importar la conexión 
    require 'includes/app.php';
    
    $db = conexionDB();
   
    // consulta a la bbdd
    
    $query = "SELECT * FROM patinetes LIMIT ${limite}";

    // Obtener resultados
    $consulta = mysqli_query($db, $query);

    //limite de productos
      
?>                  
   
   
                        <!--INICIO PATINETES-->
                    <section class="section productos productos-bici">
                <h1>Nuestros patinetes</h1>

                <div class="contenedor2 contenedor-productos">
                    <?php while($patinetes = mysqli_fetch_assoc($consulta)): ?>
                    <div class="producto">
                        
                        <img loading="lazy" class="iss" src="imagenes/<?php echo $patinetes['imagen']; ?>" alt="patinete">
                        
                            
                      
                    
                        <div class="contenido-producto">
                            <h3><?php echo $patinetes['marca']; ?> </h3>
                            <h3>Modelo: <?php echo $patinetes['modelo']; ?></h3>
                            <p></p>
                            <p class="precio"> <?php echo $patinetes['precio']; ?>€</p>
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
                                    <p><?php echo $patinetes['potencia']; ?>W</p>
                                </li>

                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dashboard" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <circle cx="12" cy="13" r="2" />
                                        <line x1="13.45" y1="11.55" x2="15.5" y2="9.5" />
                                        <path d="M6.4 20a9 9 0 1 1 11.2 0z" />
                                    </svg>
                                    <p><?php echo $patinetes['velocidad']; ?>Km/h</p>
                                </li>
                            </ul>

                            <a href="caracteristicas.php?id=<?php echo $patinetes['id']; ?>" class="boton boton-producto">Caracteristicas</a>   
                                                          
                        </div>
                    </div> 
                    <?php endwhile; ?>                       
                </div>

                <div class="ver-patinete">
                    <a href="index.php" class="boton-patinetes">volver</a>
                </div>
            </section>