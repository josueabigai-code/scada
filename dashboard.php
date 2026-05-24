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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>SCADA Dashboard</title>

<link rel="stylesheet" href="./assets/css/style.css?v=2">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="container">

<!-- SIDEBAR -->

<aside class="sidebar">

<div class="logo-box">

<div class="logo-icon">
⚡
</div>

<div>

<h2>SCADA ILUMINACIÓN</h2>

<span>Estadio Casimiro Sotelo</span>

</div>

</div>

<ul class="menu">

<li class="active">
<a href="dashboard.php">
<i class="fa fa-house"></i>
Dashboard
</a>
</li>

<li>
<a href="#">
<i class="fa fa-lightbulb"></i>
Control
</a>
</li>

<li>
<a href="reportes.php">
<i class="fa fa-file-lines"></i>
Reportes
</a>
</li>

<li>
<a href="tutorial.php">
<i class="fa fa-video"></i>
Tutorial
</a>
</li>

<li>
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

<div class="status-card">

<h3>Estado del Sistema</h3>

<p>
Servidor
<span class="online">ONLINE</span>
</p>

<p>
Base Datos
<span class="online">ONLINE</span>
</p>

<p>
PLC
<span id="plcStatus" class="offline">
DESCONECTADO
</span>
</p>

<p>
Última actualización
</p>

<span id="clock"></span>

</div>

</aside>

<!-- MAIN -->

<main class="main-content">

<!-- TOPBAR -->

<div class="topbar">

<div>

<h1>Dashboard</h1>

<p>Monitoreo y control del sistema</p>

</div>

<div class="top-actions">

<div class="plc-alert" id="plcAlert">
🔴 PLC DESCONECTADO
</div>

<button id="plcButton"
class="btn-green"
onclick="togglePLC()">

Conectar PLC

</button>

<div class="user-box">

<i class="fa fa-user-circle"></i>

<div>

<strong>Administrador</strong>

<span>admin</span>

</div>

</div>

<a href="logout.php">

<button class="btn-red">
Salir
</button>

</a>

</div>

</div>

<!-- GRID -->

<div class="dashboard-grid">

<!-- CANCHA -->

<div class="card large-card">

<div class="card-title">
<i class="fa fa-futbol"></i>
CANCHA INTERACTIVA
</div>

<div class="field">

<div id="L1"
class="lamp on"
onclick="toggleLamp('L1')">

L1

</div>

<div id="L2"
class="lamp on"
onclick="toggleLamp('L2')">

L2

</div>

<div id="L3"
class="lamp on"
onclick="toggleLamp('L3')">

L3

</div>

<div id="L4"
class="lamp"
onclick="toggleLamp('L4')">

L4

</div>

</div>

<div class="legend">

<div>
<span class="dot yellow"></span>
Encendida
</div>

<div>
<span class="dot gray"></span>
Apagada
</div>

</div>

</div>

<!-- CONTROL -->

<div class="card control-card">

<div class="card-title">
<i class="fa fa-sliders"></i>
PANEL DE CONTROL
</div>

<button class="big-btn green"
onclick="allOn()">

💡 ENCENDER TODO

</button>

<button class="big-btn red"
onclick="allOff()">

⛔ APAGAR TODO

</button>

<div class="zone-grid">

<button class="zone-btn"
onclick="zonaOeste()">

⬅ ZONA OESTE

</button>

<button class="zone-btn"
onclick="zonaEste()">

ZONA ESTE ➡

</button>

</div>

</div>

<!-- ESTADO -->

<div class="card">

<div class="card-title">
<i class="fa fa-chart-column"></i>
ESTADO DE LUMINARIAS
</div>

<div class="lamp-grid">

<div class="lamp-card"
data-lamp="L1">

<h2>L1</h2>

<p>Noroeste</p>

<div class="bulb on-bulb">
💡
</div>

<span class="status status-on">
ENCENDIDA
</span>

</div>

<div class="lamp-card"
data-lamp="L2">

<h2>L2</h2>

<p>Noreste</p>

<div class="bulb on-bulb">
💡
</div>

<span class="status status-on">
ENCENDIDA
</span>

</div>

<div class="lamp-card"
data-lamp="L3">

<h2>L3</h2>

<p>Suroeste</p>

<div class="bulb on-bulb">
💡
</div>

<span class="status status-on">
ENCENDIDA
</span>

</div>

<div class="lamp-card"
data-lamp="L4">

<h2>L4</h2>

<p>Sureste</p>

<div class="bulb off-bulb">
💡
</div>

<span class="status status-off">
APAGADA
</span>

</div>

</div>

</div>

<!-- INFO -->

<div class="card">

<div class="card-title">
<i class="fa fa-circle-info"></i>
INFORMACIÓN DEL SISTEMA
</div>

<div class="info-row">
PLC
<span id="infoPLC" class="offline">
Desconectado
</span>
</div>

<div class="info-row">
Modo
<span>Manual</span>
</div>

<div class="info-row">
Usuarios Conectados
<span>1</span>
</div>

<div class="info-row">
Versión
<span>2.0.0</span>
</div>

</div>

</div>

</main>

</div>

<script src="./assets/js/app.js?v=9999"></script>


</body>
</html>