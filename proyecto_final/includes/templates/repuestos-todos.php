<?php include 'includes/templates/header.php' ?>

<?php
    // Importar la conexión 
    require 'includes/app.php';
    
    $db = conexionDB();
   
    // consulta a la bbdd
    
    $query = "SELECT * FROM repuestos LIMIT ${limite}";

    // Obtener resultados
    $consulta2 = mysqli_query($db, $query);

    //limite de productos
      
?>    

                                     <!--INICIO BICICLETAS-->
                                     <section class="section productos-bici">
                <h2>Repuestos y recambios</h2>
                <div class="contenedor2 contenedor-productos">
                <?php while($repuestos = mysqli_fetch_assoc($consulta2)): ?>
                    <div class="producto">
                    <img loading="lazy" class="iss" src="imagenes/<?php echo $repuestos['imagen']; ?>" alt="repuesto">                    
                        <div class="contenido-producto">
                            <h3><?php echo $repuestos['marca']; ?></h3>
                            <p><?php echo $repuestos['nombre']; ?></p>
                            <p class="precio"><?php echo $repuestos['precio']; ?>€</p>
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
                                    <p>1500W</p>
                                </li>

                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dashboard" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <circle cx="12" cy="13" r="2" />
                                        <line x1="13.45" y1="11.55" x2="15.5" y2="9.5" />
                                        <path d="M6.4 20a9 9 0 1 1 11.2 0z" />
                                    </svg>
                                    <p>45Km/h</p>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bike" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <circle cx="5" cy="18" r="3" />
                                        <circle cx="19" cy="18" r="3" />
                                        <polyline points="12 19 12 15 9 12 14 8 16 11 19 11" />
                                        <circle cx="17" cy="5" r="1" />
                                      </svg>
                                      <p> 32'</p>
                                </li>
                            </ul>

                            <a href="producto.php" class="boton boton-producto">Detalles</a>                                
                                                       
                        </div>
                    </div>   
                    <?php endwhile; ?>                  
                </div>
                <div class="contenedor ver-patinete">
                    <a href="index.php" class="boton-patinetes">Volver</a>
                </div>             
            </section>