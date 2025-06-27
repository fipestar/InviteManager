<?php include_once __DIR__ . '/header.php'; ?>

    <?php if(count($eventos) === 0){ ?>
        <p class="no-eventos">No hay eventos aun <a href="/crear-evento">Crear Evento</a></p>
    <?php } else {?>
        <ul class="listado-eventos">
            <?php foreach ($eventos as $evento) {?>
              <li class="evento">
                <a href="/evento?id=<?php echo $evento->url; ?>">
                    <?php echo $evento->nombre; ?>
                </a>
              </li>
            <?php }?>    
        </ul>
        <?php }?>

<?php include_once __DIR__ . '/footer.php'; ?>