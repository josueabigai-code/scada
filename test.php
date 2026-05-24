<?php
$hash = '$2y$10$p3sYKK/kG5oGXN699YZSH.bcyy3xZAXZIu6q749LPlCvZWc4gML..';

if(password_verify("admin123",$hash)){
    echo "CORRECTO";
}else{
    echo "INCORRECTO";
}
?>