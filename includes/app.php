
<?php 
// Este archivo es clave porque configura lo esencial del proyecto y se suele incluir al inicio de toda la app 
require 'funciones.php';
require 'database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);