<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* CONEXION */

$conexion = new mysqli(
"localhost",
"root",
"12345678",
"scada"
);

/* VALIDAR */

if($conexion->connect_error){

die("Error conexión: " .
$conexion->connect_error);

}

/* UTF8 */

$conexion->set_charset("utf8");

/* RECIBIR DATOS */

$titulo = isset($_POST['titulo'])
? trim($_POST['titulo'])
: '';

$descripcion = isset($_POST['descripcion'])
? trim($_POST['descripcion'])
: '';

$estado = isset($_POST['estado'])
? trim($_POST['estado'])
: '';

/* VALIDAR */

if(
empty($titulo) ||
empty($descripcion) ||
empty($estado)
){

die("Datos incompletos");

}

/* SQL */

$stmt = $conexion->prepare(
"INSERT INTO reportes
(titulo, descripcion, estado)

VALUES (?, ?, ?)"
);

/* VALIDAR SQL */

if(!$stmt){

die("Error SQL: " .
$conexion->error);

}

/* INSERTAR */

$stmt->bind_param(
"sss",
$titulo,
$descripcion,
$estado
);

/* EJECUTAR */

if($stmt->execute()){

header("Location: ../reportes.php");

exit();

}else{

echo "Error al guardar: " .
$stmt->error;

}

$stmt->close();

$conexion->close();

?>