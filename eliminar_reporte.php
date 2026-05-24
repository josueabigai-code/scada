<?php

$conexion = new mysqli(
"localhost",
"root",
"",
"scada"
);

$id = $_GET['id'];

$sql = "DELETE FROM reportes
WHERE id='$id'";

$conexion->query($sql);

header("Location: ../reportes.php");

?>