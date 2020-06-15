<?php
/*Asignacion de parametros para la conexion*/
define('BD_USER', 'root');
define('BD_CLAVE', '');
/*Conexion a la BD*/
try {
    $conexion = new PDO('mysql:host=localhost;dbname=anthony', BD_USER, BD_CLAVE);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexion: " . $e->getMessage() . "<br/>";
}