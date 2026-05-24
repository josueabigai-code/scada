<?php

session_start();

if(isset($_SESSION['plc'])){

    echo $_SESSION['plc'];

}else{

    echo "offline";

}
?>