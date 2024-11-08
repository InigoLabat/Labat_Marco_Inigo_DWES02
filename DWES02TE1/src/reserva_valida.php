<?php
session_start();

$imagenes_coches = array(
    'Lancia Stratos' => '../images/lancia.jpg',
    'Audi Quattro' => '../images/audi.jpg',
    'Ford Escort RS1800' => '../images/ford.jpg',
    'Subaru Impreza 555' => '../images/subaru.jpg'
);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Reserva</title>
    
</head>
<body>
    <h2>¡Reserva realizada con éxito!</h2>
        
        <p><strong>Nombre:</strong> <?= $_SESSION['nombre'] ?></p>
        <p><strong>Apellido:</strong> <?=  $_SESSION['apellido'] ?></p>
        <p><strong>Modelo:</strong> <?=  $_SESSION['modelo'] ?></p>

        <img src="<?= $imagenes_coches[$_SESSION['modelo']] ?>" style="width: 300px;">