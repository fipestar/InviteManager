<?php

 namespace Controllers;

use Classes\Email;
use MVC\Router;
use Model\Usuario;

class LoginController {
    public function login(Router $router) {

        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
           $usuario = new Usuario($_POST);

           $alertas = $usuario->validarLogin();

           if(empty($alertas)) {
            //Verificar que el usuario exista
            $usuario = Usuario::where('email', $usuario->email);

            if(!$usuario || !$usuario->confirmado) {
                Usuario::setAlerta('error', 'El Usuario no existe o no está confirmado');            
            } else {
                //El usuario existe
                if(password_verify($_POST['password'], $usuario->password)){
                    //Iniciar la sesion
                    session_start();
                    //Llenar el arreglo de la sesion
                    $_SESSION['id'] = $usuario->id;
                    $_SESSION['nombre'] = $usuario->nombre;
                    $_SESSION['email'] = $usuario->email;
                    $_SESSION['login'] = true;

                    //Redireccionar
                    header('Location: /dashboard');
                }else {
                    Usuario::setAlerta('error', 'Contraseña Incorrecta');                  
                }
            }
           }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
            
        ]);
    }

    public static function login_invitado() {
        $usuario = Usuario::where('email', 'invitado@demo.com');

        if(!$usuario) {
            // Si el usuario invitado no existe, puedes manejar el error como prefieras.
            // Por ejemplo, redirigir al login con un mensaje de error.
            header('Location: /?error=invitado_no_encontrado');
            return;
        }

        // Iniciar la sesión para el usuario invitado
        session_start();
        $_SESSION['id'] = $usuario->id;
        $_SESSION['nombre'] = $usuario->nombre;
        $_SESSION['email'] = $usuario->email;
        $_SESSION['login'] = true;

        // Redireccionar al dashboard
        header('Location: /dashboard');
    }

    public static function crear(Router $router) {
        $alertas = [];
        $usuario = new Usuario;

    
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);

            $alertas = $usuario->validarNuevaCuenta();

            if(empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);
                
                if($existeUsuario){
                    Usuario::setAlerta('error', 'El Usuario ya está registrado');
                    $alertas = Usuario::getAlertas();
                }else {

                    //Hashea el password
                    $usuario->hashPassword();

                    //Eliminar passwrod2
                    unset($usuario->password2);

                    //Generar el token
                    $usuario->crearToken();

                    //Crear el usuario
                    $resultado = $usuario->guardar();

                    //Enviar email

                    $email = new Email(
                        $usuario->email,
                        $usuario->nombre,
                        $usuario->token
                    );
                    $email->enviarConfirmacion();

                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
            }
   
        }
             

        $router->render('auth/crear', [
            'titulo' => 'Crear Cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public function olvide(Router $router) {
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)){
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmado){
                    //Generar un nuevo Token
                    $usuario->crearToken();
                    unset($usuario->password2); // Eliminar el password2

                    $usuario->guardar();
                    //Enviar el email
                    $email = new Email(
                        $usuario->email,
                        $usuario->nombre,
                        $usuario->token
                    );
                    $email->enviarInstrucciones(); 
                    //Imprimir la alerta
                    Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu correo electrónico');
                    
                } else {
                    Usuario::setAlerta('error', 'El Usuario no existe o no está confirmado');
                   
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide', [
            'titulo' => 'Olvidé mi Contraseña',
            'alertas' => $alertas
        ]);

    }

    public function recuperar(Router $router) {
       $token = s($_GET['token'] ?? '');
       $mostrar = true; 

       if(!$token) header('Location: /');

       //Identififcar el usuario con este token
       $usuario = Usuario::where('token', $token);

       if(empty($usuario)){
        Usuario::setAlerta('error', 'Token no válido');
        $mostrar = false; // No mostrar el formulario si el token no es válido
       }

       if($_SERVER['REQUEST_METHOD'] === 'POST') {
          $usuario->sincronizar($_POST);

          $alertas = $usuario->validarPassword();

          if(empty($alertas)){
            //Hashear el password
            $usuario->hashPassword();
            //Eliminar el token
            $usuario->token = null;
            //Guardar el usuario en la bd
            $resultado = $usuario->guardar();
            //Redireccionar al usuario
            if($resultado){
                header('Location: /');
            }
          }
          
       }
       $alertas = Usuario::getAlertas();
       $router->render('auth/recuperar', [
           'titulo' => 'Recuperar Contraseña',
            'alertas' => $alertas,
            'mostrar' => $mostrar
       ]);
    }

    public static function mensaje(Router $router) {
        // Aquí iría la lógica para mostrar mensajes
        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta creada exitosamente'
        ]);
    }

    public static function confirmar(Router $router) {
        $token = s($_GET['token'] ?? '');

        if(!$token) header('Location: /');

        // Buscar al usuario por el token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('error', 'token no valido');
        }else {
            //Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = null; // Eliminar el token
            unset($usuario->password2); // Eliminar el password2

            //Guardar en la bd
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta confirmada correctamente');
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar', [
            'titulo' => 'Confirma tu Cuenta',
            'alertas' => $alertas

        ]);
    }


}