<div class="contenedor crear">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crear Cuenta</p>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form method="POST" action="/crear" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo $usuario->nombre ?>" >
            </div>

            <div class="campo">
                <label for="email">email</label>
                <input type="email" id="email" name="email" placeholder="Tu email" value="<?php echo $usuario->email ?>" >
            </div>

            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Tu Contraseña" >
            </div>
            
            <div class="campo">
                <label for="password2">Repite tu Contraseña</label>
                <input type="password" id="password2" name="password2" placeholder="Repite tu Contraseña" >
            </div>    
            <input type="submit" value="Crear Cuenta" class="boton">
        </form>

        <div class="acciones">
            <a href="/" class="enlace">¿Ya tienes cuenta? Inicia sesión</a>
            <a href="/olvide" class="enlace">Olvidé mi contraseña</a>
        </div>
    </div>
</div>