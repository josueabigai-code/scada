<?php
session_start();

if(!isset($_SESSION['usuario'])){
header("Location:index.php");
exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Usuarios</title>

<link rel="stylesheet"
href="./assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="container">

<aside class="sidebar">

<div class="logo-box">

<div class="logo-icon">⚡</div>

<div>
<h2>SCADA ILUMINACIÓN</h2>
<span>Estadio Casimiro Sotelo</span>
</div>

</div>

<ul class="menu">

<li>
<a href="dashboard.php">
<i class="fa fa-house"></i>
Dashboard
</a>
</li>

<li class="active">
<a href="usuarios.php">
<i class="fa fa-users"></i>
Usuarios
</a>
</li>

<li>
<a href="configuracion.php">
<i class="fa fa-gear"></i>
Configuración
</a>
</li>

<li>
<a href="historial.php">
<i class="fa fa-clock-rotate-left"></i>
Historial
</a>
</li>

</ul>

</aside>

<main class="main-content">

<h1>👥 Gestión de Usuarios</h1>

<div class="card">

<p>Panel de administración de usuarios SCADA.</p>

</div>

</main>

</div>

</body>
</html>