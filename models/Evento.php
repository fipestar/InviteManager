<?php

namespace Model;

class Evento extends ActiveRecord {

    // Nombre de la tabla y columnas
    protected static $tabla = 'eventos';
    protected static $columnasDB = [
        'id', 'nombre', 'url', 'tipo', 'descripcion',
        'fecha', 'propietarioId'
    ];

    // Propiedades del modelo
    public $id;
    public $nombre;
    public $url;
    public $tipo;
    public $descripcion;
    public $fecha;
    public $propietarioId;

    // Constructor
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->tipo = $args['tipo'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->propietarioId = $args['propietarioId'] ?? null;
    }



    // Puedes añadir un método de validación si lo necesitas
    public function validarEvento() {
        static::$alertas = [];

         if (!$this->nombre) {
             self::setAlerta('error', 'El nombre del evento es obligatorio');
         }

         if (!$this->fecha) {
             self::setAlerta('error', 'La fecha del evento es obligatoria');
         }

        if (!$this->tipo) {
            self::setAlerta('error', 'El tipo de evento es obligatorio');
        }

        return static::$alertas;
    }
}
