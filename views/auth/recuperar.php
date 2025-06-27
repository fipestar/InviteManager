<div class="contenedor recuperar">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Ingresa tu nueva contraseña</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <?php if ($mostrar) { ?>

        <form method="POST" class="formulario">
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Tu Password" >
            </div>

            <input type="submit" value="Guardar Password" class="boton">
        </form>

        <?php }; ?>

        <div class="acciones">
            <a href="/" class="enlace">¿Ya tienes cuenta? Inicia sesión</a>
            <a href="/crear" class="enlace">¿No tienes cuenta? Crea una</a>
        </div>
    </div>
</div>