<?php

namespace Controllers;

use Model\Evento;
use Model\Invitados;

class InvitadoController{
    public static function index(){
        $eventoId = $_GET['id'] ?? '';

        if(!$eventoId) header('Location: /dashboard');

        $evento = Evento::where('url', $eventoId);
        session_start();
        if(!$evento || $evento->propietarioId !== $_SESSION['id']) header('Location: /404'); 

        $invitados = Invitados::belongsTo('eventoId', $evento->id);

        echo json_encode(['invitados' => $invitados]);
    }
    public static function crear(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();

            $eventoId = $_POST['eventoId'];
            
            $evento = Evento::where('url', $eventoId);

            if(!$evento || $evento->propietarioId !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al intentar crear el invitado. Inténtalo de nuevo.'
                ];
                echo json_encode($respuesta);
                return;
            } 
            //Todo bien, crear el invitado
            $invitado = new Invitados($_POST);
            $invitado->eventoId = $evento->id;
            $resultado = $invitado->guardar();
            $respuesta = [
                'tipo' => 'exito',
                'id' => $resultado['id'],
                'mensaje' => 'Invitado creado correctamente'

            ];
            echo json_encode($respuesta);
        }
    }
    public static function actualizar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Validar que el evento exista
            $evento = Evento::where('url', $_POST['eventoId']);
            
            session_start();

            if(!$evento || $evento->propietarioId !== $_SESSION['id']){
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al intentar actualizar el invitado. Inténtalo de nuevo.'
                ];
                echo json_encode($respuesta);
                return;
            }

            $invitado = new Invitados($_POST);
            $invitado->eventoId = $evento->id;

            $resultado = $invitado->guardar();
            if($resultado) {
                $respuesta = [
                    'tipo' => 'exito',
                    'id' => $invitado->id,
                    'eventoId' => $evento->id,
                    'mensaje' => 'Invitado actualizado correctamente',
                    
                ];
            }
            echo json_encode(['respuesta' => $respuesta]);
        }
    }
    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Validar que el evento exitsta
            $evento = Evento::where('url', $_POST['eventoId']);

            session_start();

            if(!$evento || $evento->propietarioId !== $_SESSION['id']){
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al intentar eliminar el invitado. Inténtalo de nuevo.'
                ];
                echo json_encode($respuesta);
                return;
            }

            $invitado = new Invitados($_POST);
            $resultado = $invitado->eliminar();

            $resultado = [
                'resultado' => $resultado,
                'mensaje' => 'Invitado eliminado correctamente',
                'tipo' => 'exito'
            ];
            
            echo json_encode($resultado);
        }
    }
}