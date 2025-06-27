<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\InvitadoController;
use Controllers\DashboardController;
$router = new Router();

$router->get('/', [new LoginController(), 'login']);
$router->post('/', [new LoginController(), 'login']);
$router->get('/logout', [new LoginController(), 'logout']);

//Crear Cuenta
$router->get('/crear', [new LoginController(), 'crear']);
$router->post('/crear', [new LoginController(), 'crear']);

//Formulario de Olvido de Contraseña
$router->get('/olvide', [new LoginController(), 'olvide']);
$router->post('/olvide', [new LoginController(), 'olvide']);

// Recuperar Contraseña
$router->get('/recuperar', [new LoginController(), 'recuperar']);
$router->post('/recuperar', [new LoginController(), 'recuperar']);

// Confirmar Cuenta
$router->get('/mensaje', [new LoginController(), 'mensaje']);
$router->get('/confirmar', [new LoginController(), 'confirmar']);

//Zona de proyectos
$router->get('/dashboard', [new DashboardController(), 'index']);
$router->get('/crear-evento', [new DashboardController(), 'crear_evento']);
$router->post('/crear-evento', [new DashboardController(), 'crear_evento']);
$router->get('/perfil', [new DashboardController(), 'perfil']);
$router->post('/perfil', [new DashboardController(), 'perfil']);
$router->get('/evento', [new DashboardController(), 'evento']);
$router->get('/cambiar-password', [new DashboardController(), 'cambiar_password']);
$router->post('/cambiar-password', [new DashboardController(), 'cambiar_password']);


//Api para los invitados
$router->get('/api/invitados', [new InvitadoController(), 'index']);
$router->post('/api/invitado', [new InvitadoController(), 'crear']);
$router->post('/api/invitado/actualizar', [new InvitadoController(), 'actualizar']);
$router->post('/api/invitado/eliminar', [new InvitadoController(), 'eliminar']);






// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();