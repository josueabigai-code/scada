<?php

$conexion = new mysqli(
"localhost",
"root",
"",
"scada"
);

$id = $_POST['id'];

$titulo = $_POST['titulo'];

$descripcion = $_POST['descripcion'];

$estado = $_POST['estado'];

$sql = "UPDATE reportes SET

titulo='$titulo',
descripcion='$descripcion',
estado='$estado'

WHERE id='$id'";

$conexion->query($sql);

header("Location: ../reportes.php");

?>