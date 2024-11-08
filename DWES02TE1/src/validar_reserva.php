<?php
require 'datos.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$modelo = $_POST['modelo'];
$fecha_inicio = $_POST['fecha_inicio'];
$duracion = (int)$_POST['duracion'];

$errores = array(
    'dni' => 'incorrecto',
    'usuario' => 'incorrecto',
    'modelo' => 'incorrecto',
    'nombre' => 'incorrecto',
    'apellido' => 'incorrecto',
    'fecha_inicio' => 'incorrecto',
    'duracion' => 'incorrecto'
);
$reserva_valida = true;

// Añadimos la función para comprobar si es un dni valido segun modulo23
function letra_nif($dni) {
    return substr("TRWAGMYFPDXBNJZSQVHLCKE",strtr($dni,"XYZ","012")%23,1);
};

function comprobar_dni($dni) {
    foreach(USUARIOS as $usuario) {
        if ($usuario['dni'] === $dni) {
            return true;
        }
    }

    if (strlen($dni) != 9) {
        return false;
    } else {
        $numero = substr($dni, 0, -1);
        $letra = strtoupper(substr($dni, -1));
        if ($letra === letra_nif($numero)){
            return true;
        }
        return false;
    }
}


function usuarioRegistrado($nombre, $apellido, $dni){
    foreach(USUARIOS as $usuario) {
        if ($usuario['nombre'] === $nombre && $usuario['apellido'] === $apellido && $usuario['dni'] === $dni) {
            return true;
        }
    }
    return false;
}

// Pasamos el array de los errores por referencia, para que se guarden las modificaciones que se hagan
function comprobarVehic($coches, $modelo) {
    foreach ($coches as $coche) {
        if ($modelo === $coche["modelo"] && $coche['disponible']) {
            return true;
        }
    }
    return false;
}

//Una vez creadas nuestras funciones, empezamos con las comprobaciones una a una
if (empty($nombre)) { 
    $reserva_valida = false;
} else {
    $errores['nombre'] = 'correcto';
}

if (empty($apellido)) { 
    $reserva_valida = false;
} else {
    $errores['apellido'] = 'correcto';
}

if (comprobar_dni($dni)) {
    $errores['dni'] = 'correcto';
} else { 
    $reserva_valida = false; 
}

if (usuarioRegistrado($nombre, $apellido, $dni)) {
    $errores['usuario'] = 'correcto';
} else { 
    $reserva_valida = false; 
}

if ($fecha_inicio < date("Y-m-d")) { 
    $reserva_valida = false;
} else {
    $errores['fecha_inicio'] = 'correcto';
}

if (!is_int($duracion) || $duracion < 1 || $duracion > 30) { 
    $reserva_valida = false;
} else {
    $errores['duracion'] = 'correcto';
}

if (comprobarVehic($coches, $modelo)){
    $errores['modelo'] = 'correcto';
} else { 
    $reserva_valida = false; 
}

session_start();
$_SESSION['nombre'] = $nombre;
$_SESSION['apellido'] = $apellido;
$_SESSION['modelo'] = $modelo;

if ($reserva_valida) {
    header("Location: reserva_valida.php");
} else {
    $_SESSION['dni'] = $dni;
    $_SESSION['fecha_inicio'] = $fecha_inicio;
    $_SESSION['duracion'] = $duracion;

    $_SESSION['errores'] = $errores;
    header("Location: reserva_fallida.php");
}