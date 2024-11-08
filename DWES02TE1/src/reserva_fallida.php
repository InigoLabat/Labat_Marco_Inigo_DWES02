<?php
session_start();

// Recuperamos los valores ingresados y el array de errores desde la sesión
$nombre = $_SESSION['nombre'] ?? '';
$apellido = $_SESSION['apellido'] ?? '';
$dni = $_SESSION['dni'] ?? '';
$modelo = $_SESSION['modelo'] ?? '';
$fecha_inicio = $_SESSION['fecha_inicio'] ?? '';
$duracion = $_SESSION['duracion'] ?? '';

$errores = $_SESSION['errores'] ?? [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Reserva</title>
    <style>
        .correcto { color: green; }
        .incorrecto { color: red; }
    </style>
</head>
<body>
    <h2>La reserva no es válida</h2>
    <p>Por favor, revisa y corrige los campos en rojo:</p>
    
    <!-- Mensaje específico si el usuario no está registrado -->
    <?php if ($errores['usuario'] === 'incorrecto'): ?>
        <p class="incorrecto">Usuario no registrado</p>

        <ul>
            <li class="incorrecto">
                <!-- usamos operadores ternarios para elegir que se muestra en cada campo -->
                Nombre: <?= $errores['nombre'] === 'correcto' ? $nombre : "No válido" ?>
            </li>
            <li class="incorrecto">
                Apellido: <?= $errores['apellido'] === 'correcto' ? $apellido : "No válido" ?>
            </li>
            <li class="incorrecto">
                DNI: <?= $errores['dni'] === 'correcto' ? $dni : "No válido" ?>
            </li>

    <?php else: ?>

        <ul>
            <li class="<?= $errores['nombre']?>">
                Nombre: <?= $errores['nombre'] === 'correcto' ? $nombre : "No válido" ?>
            </li>
            <li class="<?= $errores['apellido']?>">
                Apellido: <?= $errores['apellido'] === 'correcto' ? $apellido : "No válido" ?>
            </li>
            <li class="<?= $errores['dni']?>">
                DNI: <?= $errores['dni'] === 'correcto' ? $dni : "No válido" ?>
            </li>
    <?php endif; ?>

        <li class="<?= $errores['fecha_inicio']?>">
            Fecha de Inicio: <?= $errores['fecha_inicio'] === 'correcto' ? $fecha_inicio : "La fecha de inicio debe ser posterior a hoy" ?>
        </li>
        <li class="<?= $errores['duracion']?>">
            Duración: <?= $errores['duracion'] === 'correcto' ? $duracion : "La duración debe ser entre 1 y 30 dáis" ?>
        </li>
        <li class="<?= $errores['modelo']?>">
            Modelo: <?= $errores['modelo'] === 'correcto' ? $modelo : "Modelo no disponible" ?>
        </li>
    </ul>
</body>
</html>