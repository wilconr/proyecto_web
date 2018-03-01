<?php
include '../conexion/conexion.php';
$id = $conexion->real_escape_string(htmlentities($_GET['id']));
$delete = $conexion->query("DELETE FROM usuarios WHERE id_usuario='$id'");

if ($delete)
{
  header('location:../extend/alerta.php?msj=Usuario eliminado&c=us&p=in&t=success');
}
else
{
  header('location:../extend/alerta.php?msj=El usuario no pudo ser eliminado&c=us&p=in&t=error');
}
$conexion->close();
?>
