<?php

namespace Controllers;
use MVC\Router;
use Model\Evento;
use Model\Usuario;

class DashboardController {
    public function index(Router $router) {
        session_start();
        isAuth();

        $id = $_SESSION['id'];

        $eventos = Evento::belongsTo('propietarioId', $id);

        $router->render('dashboard/index', [
            'titulo' => 'Eventos',
            'eventos' => $eventos
        ]);
    }

    public function crear_evento(Router $router) {
        session_start();
        isAuth();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $evento = new Evento($_POST);

            //Validacion
            $alertas = $evento->validarEvento();

            if(empty($alertas)){
                $hash = md5(uniqid());
                $evento->url = $hash;
                

                //Almacenamos el creador del evento
                $evento->propietarioId = $_SESSION['id'];

                

                //Guardamos el evento
                $evento->guardar();

                //Redireccionamos
                header('Location: /evento?id=' . $evento->url);
            }
        }
        $router->render('dashboard/crear-evento', [
            'alertas' => $alertas,
            'titulo' => 'Crear Evento'
        ]);
    }

    public function perfil(Router $router) {
        session_start();
        isAuth();
        $alertas = [];

        $usuario = Usuario::find($_SESSION['id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);

            $alertas = $usuario->validar_perfil(); 

            if(empty($alertas)) {
                //Comprobar que el email no exista
                $existeUsuario = Usuario::where('email', $usuario->email);
                if($existeUsuario && $existeUsuario->id !== $usuario->id){
                    Usuario::setAlerta('error', 'El Email ya está en uso');
                    $alertas = Usuario::getAlertas();
                } else {
                    //Guardamos los cambios
                    $usuario->guardar();
                    Usuario::setAlerta('exito', 'Cambios Guardados Correctamente');
                    $alertas = Usuario::getAlertas();

                    //Asignar al usuario a la sesion
                    $_SESSION['nombre'] = $usuario->nombre;
                }
            }
        }
        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }

    public static function evento(Router $router) {
        session_start();
        isAuth();

        $token = $_GET['id'] ?? '';
        if(!$token) header('Location: /dashboard');

        //Revisar que la presona que visita el evento es quien lo creo
        $evento = Evento::where('url', $token);
        if($evento->propietarioId !== $_SESSION['id']) {
            header('Location: /dashboard');
        }
        $router->render('dashboard/evento', [
            'titulo' => $evento->nombre
        ]);
    }

    public static function cambiar_password(Router $router) {
        session_start();
        isAuth();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = Usuario::find($_SESSION['id']);
            $usuario->sincronizar($_POST);

            //Validar el password
            $alertas = $usuario->nuevo_password();

            if(empty($alertas)){
                $resultado = $usuario->comprobar_password();

                if($resultado){
                    //Hasheamos el nuevo password
                    $usuario->password = $usuario->password_nuevo;

                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);

                    $usuario->hashPassword();

                    //Actualizamos el usuario
                    $resultado = $usuario->guardar();

                    if($resultado) {
                        Usuario::setAlerta('exito', 'Password Cambiado Correctamente');
                        $alertas = Usuario::getAlertas();
                    }
                }else {
                    Usuario::setAlerta('error', 'El Password Actual es Incorrecto');
                    $alertas = Usuario::getAlertas();
                }
            }   

        }
        $router->render('dashboard/cambiar-password', [
            'titulo' => 'Cambiar Password',
            'alertas' => $alertas
        ]);
        
    }

    
}