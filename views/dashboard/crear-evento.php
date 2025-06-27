<?php include_once __DIR__ . '/header.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario" method="POST" action="/crear-evento">
        <?php include_once __DIR__ . '/formulario-evento.php'; ?>
        <input type="submit" value="Crear Evento">
    </form>
</div>

<?php include_once __DIR__ . '/footer.php'; ?>