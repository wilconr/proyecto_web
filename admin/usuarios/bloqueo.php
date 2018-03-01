<?php
include '../conexion/conexion.php';
$user = $_SESSION['nick'];
$update = $conexion->query("UPDATE usuarios SET bloqueo_usuario=0 WHERE nick_usuario='$user'");
if ($update)
{
  $_SESSION = array();
  session_destroy();
  header('location:../extend/alerta.php?msj=USO INDEVIDO DEL SISTEMA&c=salir&p=salir&t=error');
}
$conexion->close();
?>
