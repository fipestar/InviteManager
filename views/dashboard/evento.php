<?php include_once __DIR__ . '/header.php'; ?>

 <div class="contenedor-sm">
    <div class="contenedor-nuevo-invitado">
        <button type="button" class="agregar-invitados" id="agregar-invitados">
            &#43; Agregar Invitados
        </button>
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
    </div>
 </div>
<ul class="listado-invitados" id="listado-invitados"></ul>
</div>
<?php include_once __DIR__ . '/footer.php'; ?>

<?php 
   $script .= '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><script src="build/js/invitados.js"></script>';
?>
