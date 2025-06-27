<?php include_once __DIR__ . '/header.php'; ?>

 <div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <a href="/perfil" class="enlace">Volver a Perfil</a>

    <form method="POST" class="formulario" action="/cambiar-password">
        <div class="campo">
            <label for="nombre">Password actual</label>
            <input type="password" name="password_actual" placeholder="Tu Password Actual" />
        </div>

        <div class="campo">
            <label for="nombre">Nuevo Password</label>
            <input type="password" name="password_nuevo" placeholder="Tu Nuevo Password" />
        </div>

        <input type="submit" value="Cambiar Password"/>
    </form>
 </div>

<?php include_once __DIR__ . '/footer.php'; ?>