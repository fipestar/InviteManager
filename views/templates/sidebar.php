<aside class="sidebar">
    <div class="contenedor-sidebar">
        <h2>InviteManager</h2>

        <div class="cerrar-menu">
            <img id="cerrar-menu" src="build/img/cerrar.svg" alt="imagen cerrar">
        </div>
    </div>
    
    <nav class="sidebar-nav">
        <a class="<?php echo ($titulo === 'Eventos') ? 'activo' : ''; ?>" href="/dashboard">Dashboard</a>
        <a class="<?php echo ($titulo === 'Crear Evento') ? 'activo' : ''; ?>" href="/crear-evento">Crear Evento</a>
        <a class="<?php echo ($titulo === 'Perfil') ? 'activo' : ''; ?>" href="/perfil">Perfil</a>
    </nav>

    <div class="cerrar-sesion-mobile">
        <a href="/logout" class="cerrar-sesion">Cerrar Sesion</a>
    </div>
</aside>