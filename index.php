<?php
session_start();

$error = "";

if(isset($_POST['login'])){

$usuario = trim($_POST['usuario']);
$password = trim($_POST['password']);

if($usuario === "admin" && $password === "admin123"){

$_SESSION['usuario'] = $usuario;

header("Location: dashboard.php");

exit();

}else{

$error = "Usuario o contraseña incorrecta";

}

}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>SCADA LOGIN</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{

height:100vh;

display:flex;
justify-content:center;
align-items:center;

overflow:hidden;

background:
linear-gradient(
135deg,
#020b1d,
#07152f,
#0b2148
);

position:relative;
}

/* FONDO ANIMADO */

body::before{

content:"";

position:absolute;

width:700px;
height:700px;

background:
radial-gradient(
circle,
rgba(33,85,255,.25),
transparent 70%
);

top:-200px;
left:-150px;

animation:move1 8s infinite alternate;
}

body::after{

content:"";

position:absolute;

width:600px;
height:600px;

background:
radial-gradient(
circle,
rgba(0,255,136,.12),
transparent 70%
);

bottom:-200px;
right:-150px;

animation:move2 10s infinite alternate;
}

@keyframes move1{

from{
transform:translateY(0);
}

to{
transform:translateY(40px);
}

}

@keyframes move2{

from{
transform:translateX(0);
}

to{
transform:translateX(-40px);
}

}

/* LOGIN */

.login-container{

width:460px;

padding:45px;

border-radius:28px;

background:
rgba(8,22,48,.75);

border:
1px solid rgba(255,255,255,.08);

backdrop-filter:blur(18px);

box-shadow:
0 0 45px rgba(0,0,0,.45);

position:relative;

z-index:2;
}

.logo{

display:flex;
align-items:center;
gap:18px;

margin-bottom:35px;
}

.logo-icon{

width:75px;
height:75px;

border-radius:22px;

display:flex;
justify-content:center;
align-items:center;

font-size:34px;

background:
linear-gradient(
135deg,
#2155ff,
#00c6ff
);

box-shadow:
0 0 25px rgba(33,85,255,.5);
}

.logo-text h1{

font-size:30px;

font-weight:700;

color:white;
}

.logo-text p{

margin-top:5px;

color:#8fa7c8;

font-size:15px;
}

/* FORM */

.form-group{
margin-bottom:22px;
}

.form-group label{

display:block;

margin-bottom:10px;

color:#b7c9e5;

font-size:14px;
}

.input-box{

position:relative;
}

.input-box i{

position:absolute;

top:18px;
left:18px;

color:#7e9ac2;
}

.input-box input{

width:100%;

padding:16px 16px 16px 52px;

border:none;

outline:none;

border-radius:16px;

background:#102446;

color:white;

font-size:16px;

transition:.3s;
}

.input-box input:focus{

border:
1px solid #2155ff;

box-shadow:
0 0 15px rgba(33,85,255,.4);
}

/* BOTON */

.login-btn{

width:100%;

padding:17px;

border:none;

border-radius:18px;

font-size:17px;

font-weight:bold;

cursor:pointer;

color:white;

background:
linear-gradient(
90deg,
#2155ff,
#3d7dff
);

transition:.3s;

margin-top:10px;

box-shadow:
0 0 20px rgba(33,85,255,.4);
}

.login-btn:hover{

transform:translateY(-3px);

box-shadow:
0 0 30px rgba(33,85,255,.6);
}

/* ERROR */

.error{

background:
rgba(255,23,68,.15);

border:
1px solid rgba(255,23,68,.3);

padding:15px;

border-radius:14px;

margin-bottom:20px;

color:#ff6b81;

text-align:center;
}

/* FOOTER */

.footer{

margin-top:28px;

text-align:center;

color:#7f96b5;

font-size:13px;
}

.footer span{
color:#00e676;
}

/* RESPONSIVE */

@media(max-width:500px){

.login-container{

width:92%;

padding:30px;
}

.logo{
flex-direction:column;
text-align:center;
}

}

</style>

</head>

<body>

<div class="login-container">

<div class="logo">

<div class="logo-icon">
⚡
</div>

<div class="logo-text">

<h1>SCADA ILUMINACIÓN</h1>

<p>Estadio Casimiro Sotelo</p>

</div>

</div>

<?php if($error!=""){ ?>

<div class="error">

<?= $error; ?>

</div>

<?php } ?>

<form method="POST">

<div class="form-group">

<label>Usuario</label>

<div class="input-box">

<i class="fa fa-user"></i>

<input type="text"
name="usuario"
placeholder="Ingrese usuario"
required>

</div>

</div>

<div class="form-group">

<label>Contraseña</label>

<div class="input-box">

<i class="fa fa-lock"></i>

<input type="password"
name="password"
placeholder="Ingrese contraseña"
required>

</div>

</div>

<button type="submit"
name="login"
class="login-btn">

<i class="fa fa-right-to-bracket"></i>

INGRESAR

</button>

</form>

<div class="footer">

Sistema SCADA Inteligente •
<span>ONLINE</span>

</div>

</div>

</body>
</html>