<?php
$consulta = $_GET['consulta'] ?? null; 
?>



<?php include 'includes/templates/header.php' ?>


<main class="contenedor-contacto" action="contacto" method="POST">
<?php if(intval( $consulta ) === 1): ?>
    <p class="mensaje">Ok!! Te contactaremos a la brevedad</p>
    <div class="email">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-thumb-up" width="100" height="100" viewBox="0 0 24 24" stroke-width="2" stroke="#7bb922" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3" />
        </svg>   
    </div>        
<?php  endif; ?>
    <h1>Tu zona de contacto </h1>
    <div class="contenedor cont-img">
        <img class="img-contacto" loading="lazy" src="img/imagen3.jpg">     
    </div>   
</main>


<section class="contenedor contact">
    <div class=" section-contacto">
        <h2>¿Quieres vender tu patinete o bici eléctrica? Contacta con nosotros y haz tu oferta!!</h2>
        <form class="contenedor formulario" action="formulario.php" method="POST">
            <fieldset>
                <legend>Formulario de contacto</legend>
        
                <label for="nombre">Nombre:</label>
                <input type="text" placeholder="Tu Nombre" id="nombre" name="nombre" required>
                
                <label for="email">E-mail:</label>
                <input type="mail" placeholder="Tu E-mail" id="email" name="email" required>
        
                <label for="telefono">Teléfono:</label>
                <input type="mail" placeholder="Tu teléfono" id="telefono" name="telefono">
        
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje"> </textarea>              
            </fieldset>
        

            <fieldset>
                <legend>Cuéntanos que vendes y sus detalles.</legend>
                <select id="opciones" name="opciones" required>
                    <option value="" disabled selected>-- Selecciona --</option>
                    <option value="Patinete">Patinete</option>
                    <option value="Bicicleta">Bicicleta</option>
                </select>
        
                <label for="precio">Precio de venta:</label>
                <input type="number" placeholder="Tu precio de venta:" id="precio" name="precio" required>      
            </fieldset>
        

            <fieldset>
                <legend>¿Cómo quieres que te contactemos?</legend>
                
                <div class="tipo-contacto">
                    <label class="radio" for="tipo-telefono">Teléfon</label>
                    <input class="radio" name="contacto" type="radio" value="telefono" id="tipo-telefono" name="contacto">
        
                    <label class="radio" for="tipo-email">E-mail</label>
                    <input class="radio" name="contacto" type="radio" value="email" id="tipo-email" name="contacto">
        
                </div>
                <p>Dinos la hora y fecha en la que prefieres ser contactado</p>
        
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha">
        
                    <label for="hora">Hora:</label>
                    <input type="time" id="hora" min="09:00" max="20:00" name="hora">
        
            </fieldset>
                
                <input type="submit" value="Enviar" class="enviar-contacto">
        
        </form>
        
    </div>
</section>

<div class="contenedor-caja">
    <div class="redes-sociales">
        <ul class="ul">
            <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-twitter" width="76" height="76" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c-.002 -.249 1.51 -2.772 1.818 -4.013z" />
            </svg></li>
            <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook" width="76" height="76" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
            </svg></li>
            <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-tiktok" width="76" height="76" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M9 12a4 4 0 1 0 4 4v-12a5 5 0 0 0 5 5" />
            </svg></li>  
            <li><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp" width="76" height="76" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                <path d="M9 10a0.5 .5 0 0 0 1 0v-1a0.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a0.5 .5 0 0 0 0 -1h-1a0.5 .5 0 0 0 0 1" />
            </svg></li>
        </ul>

    </div>
</div>