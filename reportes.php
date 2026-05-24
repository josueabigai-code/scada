<?php
session_start();

if(!isset($_SESSION['usuario'])){
header("Location:index.php");
exit();
}

/* CONEXION */

$conexion = new mysqli(
"localhost",
"root",
"12345678",
"scada"
);

/* VALIDAR */

if($conexion->connect_error){
die("Error conexión");
}

$conexion->set_charset("utf8");

/* CONSULTA */

$sql = "SELECT * FROM reportes ORDER BY id DESC";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>SCADA Reportes</title>

<link rel="stylesheet"
href="./assets/css/style.css?v=15">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

.report-wrapper{
margin-left:280px;
padding:35px;
}

.report-top{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}

.report-title h1{
font-size:42px;
margin-bottom:10px;
}

.report-title p{
color:#8ea5c6;
}

.new-btn{
background:
linear-gradient(
90deg,
#2155ff,
#3f7bff
);

padding:16px 28px;

border:none;

border-radius:16px;

color:white;

font-size:16px;

font-weight:bold;

cursor:pointer;

transition:.3s;

box-shadow:
0 0 25px rgba(33,85,255,.5);
}

.new-btn:hover{
transform:translateY(-3px);
}

.report-card{
background:
rgba(7,21,47,.8);

border:
1px solid rgba(255,255,255,.05);

padding:30px;

border-radius:25px;

backdrop-filter:blur(12px);

box-shadow:
0 0 35px rgba(0,0,0,.4);
}

.table-container{
overflow-x:auto;
}

.report-table{
width:100%;
border-collapse:collapse;
}

.report-table thead{
background:
linear-gradient(
90deg,
#0f2c5c,
#173c78
);
}

.report-table th{
padding:22px;
text-align:left;
font-size:15px;
color:#c7d5eb;
text-transform:uppercase;
letter-spacing:1px;
}

.report-table td{
padding:22px;
border-bottom:
1px solid rgba(255,255,255,.05);
color:white;
}

.report-table tbody tr{
transition:.3s;
}

.report-table tbody tr:hover{
background:
rgba(255,255,255,.03);
}

.status{
padding:10px 18px;
border-radius:30px;
font-size:13px;
font-weight:bold;
display:inline-block;
}

.status-process{
background:
rgba(255,193,7,.2);

color:#ffd54f;

border:
1px solid rgba(255,193,7,.3);
}

.status-ok{
background:
rgba(0,200,83,.2);

color:#00e676;

border:
1px solid rgba(0,200,83,.3);
}

.status-pending{
background:
rgba(255,23,68,.2);

color:#ff5252;

border:
1px solid rgba(255,23,68,.3);
}

.actions{
display:flex;
gap:10px;
}

.action{
width:42px;
height:42px;
border:none;
border-radius:12px;
cursor:pointer;
transition:.3s;
color:white;
}

.action:hover{
transform:translateY(-3px);
}

.view{
background:#00c853;
}

.edit{
background:#2155ff;
}

.delete{
background:#ff1744;
}

.modal{
display:none;
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:
rgba(0,0,0,.7);

backdrop-filter:blur(5px);

justify-content:center;
align-items:center;

z-index:999;
}

.modal-content{
width:550px;

background:
linear-gradient(
180deg,
#081a38,
#09142a
);

padding:35px;

border-radius:25px;

border:
1px solid rgba(255,255,255,.05);

box-shadow:
0 0 45px rgba(0,0,0,.5);
}

.modal-content h2{
margin-bottom:25px;
font-size:30px;
}

.form-group{
margin-bottom:18px;
}

.form-group label{
display:block;
margin-bottom:8px;
color:#9eb4d1;
}

.form-control{
width:100%;
padding:16px;
border:none;
border-radius:14px;
background:#13284b;
color:white;
font-size:15px;
outline:none;
}

.save-btn{
width:100%;
padding:18px;
border:none;
border-radius:16px;

background:
linear-gradient(
90deg,
#00c853,
#00e676
);

font-size:18px;
font-weight:bold;
color:white;
cursor:pointer;
}

.empty{
text-align:center;
padding:50px;
color:#8ea5c6;
}

</style>

</head>

<body>

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

<li>
<a href="dashboard.php">
<i class="fa fa-house"></i>
Dashboard
</a>
</li>

<li class="active">
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

</aside>

<!-- CONTENT -->

<div class="report-wrapper">

<div class="report-top">

<div class="report-title">

<h1>📄 Gestión de Reportes</h1>

<p>
Administración de incidencias del sistema
</p>

</div>

<button class="new-btn"
onclick="openModal()">

<i class="fa fa-plus"></i>
Nuevo Reporte

</button>

</div>

<div class="report-card">

<div class="table-container">

<table class="report-table">

<thead>

<tr>

<th>ID</th>
<th>Título</th>
<th>Descripción</th>
<th>Estado</th>
<th>Fecha</th>
<th>Acciones</th>

</tr>

</thead>

<tbody>

<?php

if($resultado->num_rows > 0){

while($fila = $resultado->fetch_assoc()){

?>

<tr>

<td>#<?= $fila['id']; ?></td>

<td><?= $fila['titulo']; ?></td>

<td><?= $fila['descripcion']; ?></td>

<td>

<?php

if($fila['estado']=="En Proceso"){

echo "<span class='status status-process'>
En Proceso
</span>";

}elseif($fila['estado']=="Resuelto"){

echo "<span class='status status-ok'>
Resuelto
</span>";

}else{

echo "<span class='status status-pending'>
Pendiente
</span>";

}

?>

</td>

<td><?= $fila['fecha']; ?></td>

<td>

<div class="actions">

<button class="action view"
onclick="verReporte(
'<?= $fila['titulo']; ?>',
'<?= $fila['descripcion']; ?>',
'<?= $fila['estado']; ?>',
'<?= $fila['fecha']; ?>'
)">
<i class="fa fa-eye"></i>
</button>

<button class="action edit"
onclick="editarReporte(
<?= $fila['id']; ?>,
'<?= $fila['titulo']; ?>',
'<?= $fila['descripcion']; ?>',
'<?= $fila['estado']; ?>'
)">
<i class="fa fa-pen"></i>
</button>

<a href="./api/eliminar_reporte.php?id=<?= $fila['id']; ?>"
onclick="return confirm('¿Eliminar reporte?')">

<button class="action delete"
type="button">

<i class="fa fa-trash"></i>

</button>

</a>

</div>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="6">

<div class="empty">

<i class="fa fa-folder-open"
style="font-size:60px;margin-bottom:20px;"></i>

<h2>No existen reportes</h2>

</div>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

<!-- MODAL NUEVO -->

<div class="modal"
id="modal">

<div class="modal-content">

<h2>Nuevo Reporte</h2>

<form action="./api/guardar_reporte.php"
method="POST">

<div class="form-group">

<label>Título</label>

<input type="text"
name="titulo"
class="form-control"
required>

</div>

<div class="form-group">

<label>Descripción</label>

<textarea
name="descripcion"
class="form-control"
rows="5"
required></textarea>

</div>

<div class="form-group">

<label>Estado</label>

<select
name="estado"
class="form-control">

<option>En Proceso</option>
<option>Resuelto</option>
<option>Pendiente</option>

</select>

</div>

<button type="submit"
class="save-btn">

Guardar Reporte

</button>

</form>

</div>

</div>

<!-- MODAL VER -->

<div class="modal"
id="viewModal">

<div class="modal-content">

<h2>Detalle del Reporte</h2>

<div class="form-group">

<label>Título</label>

<input type="text"
id="viewTitulo"
class="form-control"
readonly>

</div>

<div class="form-group">

<label>Descripción</label>

<textarea
id="viewDescripcion"
class="form-control"
rows="5"
readonly></textarea>

</div>

<div class="form-group">

<label>Estado</label>

<input type="text"
id="viewEstado"
class="form-control"
readonly>

</div>

<div class="form-group">

<label>Fecha</label>

<input type="text"
id="viewFecha"
class="form-control"
readonly>

</div>

<button class="save-btn"
onclick="closeViewModal()">

Cerrar

</button>

</div>

</div>

<!-- MODAL EDITAR -->

<div class="modal"
id="editModal">

<div class="modal-content">

<h2>Editar Reporte</h2>

<form action="./api/editar_reporte.php"
method="POST">

<input type="hidden"
name="id"
id="editId">

<div class="form-group">

<label>Título</label>

<input type="text"
name="titulo"
id="editTitulo"
class="form-control"
required>

</div>

<div class="form-group">

<label>Descripción</label>

<textarea
name="descripcion"
id="editDescripcion"
class="form-control"
rows="5"
required></textarea>

</div>

<div class="form-group">

<label>Estado</label>

<select
name="estado"
id="editEstado"
class="form-control">

<option>En Proceso</option>
<option>Resuelto</option>
<option>Pendiente</option>

</select>

</div>

<button type="submit"
class="save-btn">

Actualizar Reporte

</button>

</form>

</div>

</div>

<script>

function openModal(){
document.getElementById("modal")
.style.display = "flex";
}

function verReporte(
titulo,
descripcion,
estado,
fecha
){

document.getElementById("viewTitulo").value = titulo;
document.getElementById("viewDescripcion").value = descripcion;
document.getElementById("viewEstado").value = estado;
document.getElementById("viewFecha").value = fecha;

document.getElementById("viewModal")
.style.display = "flex";

}

function closeViewModal(){

document.getElementById("viewModal")
.style.display = "none";

}

function editarReporte(
id,
titulo,
descripcion,
estado
){

document.getElementById("editId").value = id;
document.getElementById("editTitulo").value = titulo;
document.getElementById("editDescripcion").value = descripcion;
document.getElementById("editEstado").value = estado;

document.getElementById("editModal")
.style.display = "flex";

}

window.onclick = function(e){

let modal =
document.getElementById("modal");

let viewModal =
document.getElementById("viewModal");

let editModal =
document.getElementById("editModal");

if(e.target == modal){
modal.style.display = "none";
}

if(e.target == viewModal){
viewModal.style.display = "none";
}

if(e.target == editModal){
editModal.style.display = "none";
}

}

</script>

</body>
</html>