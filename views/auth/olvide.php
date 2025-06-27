<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        <p class="descripcion-pagina">Ingresa tu correo para recuperar tu contraseña</p>

        <form method="POST" action="/olvide" class="formulario" novalidate>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Tu Email" required>
            </div>

            <input type="submit" value="Iniciar Sesión" class="boton">
        </form>

        <div class="acciones">
            <a href="/" class="enlace">¿Ya tienes cuenta? Inicia sesión</a>
            <a href="/crear" class="enlace">¿No tienes cuenta? Crea una</a>
        </div>
    </div>
</div>