<?php

namespace Model;

class Invitados extends ActiveRecord {
    protected static $tabla = 'invitados';
    protected static $columnasDB = ['id', 'nombre', 'asistencia', 'eventoId', 'parentesco'];

    public $id;
    public $nombre;
    public $asistencia;
    public $eventoId;
    public $parentesco;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->asistencia = $args['asistencia'] ?? 0;
        $this->eventoId = $args['eventoId'] ?? '';
        $this->parentesco = $args['parentesco'] ?? '';
        
    }
}