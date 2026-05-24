<?php

$accion = $_GET['accion'];

$output = shell_exec(
"python ../python/plc_control.py $accion"
);

echo $output;

?>