<?php include_once __DIR__ . '/header.php'; ?>

 <div class="contenedor-sm">
    <div class="contenedor-nuevo-invitado">
        <button type="button" class="agregar-invitados" id="agregar-invitados">
            &#43; Agregar Invitados
        </button>
    </div>

    <div class="detalles-evento">
        <button type="button" class="mostrar-detalles-evento" id="mostrar-detalles-evento">Mostrar Detalles del Evento</button>
        <div class="contenedor-detalles" id="contenedor-detalles">
            <p><span>Descripción:</span> <?php echo $evento->descripcion; ?></p>
            <p><span>Fecha:</span> <?php echo $evento->fecha; ?></p>
            <p><span>Tipo:</span> <?php echo $evento->tipo; ?></p>
        </div>
    </div>

 <div id="filtros" class="filtros">
    <div class="filtros-inputs">
        <h2>Filtros:</h2>
        <div class="campo">
            <label for="todas">Todas</label>
            <input type="radio" name="filtro" id="todas" value="" checked>
        </div>

        <div class="campo">
            <label for="asisten">Asisten</label>
            <input type="radio" name="filtro" id="asisten" value="1">
        </div>

        <div class="campo">
            <label for="inasisten">No asisten</label>
            <input type="radio" name="filtro" id="inasisten" value="0">
        </div>

        <div class="campo">
            <label for="parentesco">Parentesco</label>
            <select name="parentesco" id="parentesco">
                <option value="">Todos</option>
                <option value="familia">Familia</option>
                <option value="amigos">Amigos</option>
                <option value="colegas">Colegas</option>
            </select>
        </div>
    </div>
 </div>
<ul class="listado-invitados" id="listado-invitados"></ul>
</div>
<?php include_once __DIR__ . '/footer.php'; ?>

<?php 
   $script .= '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><script src="build/js/invitados.js"></script>';
?>
