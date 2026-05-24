<?php
$conn = new mysqli("localhost","root","12345678","scada");

if($conn->connect_error){
    die("Error conexión: " . $conn->connect_error);
}
?>