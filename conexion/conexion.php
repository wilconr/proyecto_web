<?php

@session_start();
require_once "global.php";

$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');

//Si tenemos un posible error en la conexion lo mostramos
if (mysqli_connect_errno())
{
    printf("Fallo la conexion a la base de datos: %s\n",mysqli_connect_errno());
    exit();
}

?>
