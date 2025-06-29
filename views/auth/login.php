<div class="contenedor login">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesion</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form method="POST" action="/" class="formulario" novalidate>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Tu Email" required>
            </div>

            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Tu Contraseña" required>
            </div>
            <input type="submit" value="Iniciar Sesión" class="boton">
            <a href="/login-invitado" class="boton-invitado">Probar como Invitado</a>
        </form>

        <div class="acciones">
            <a href="/crear" class="enlace">¿No tienes cuenta? Crea una</a>
            <a href="/olvide" class="enlace">Olvidé mi contraseña</a>
        </div>
    </div>
</div>