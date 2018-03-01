<?php

include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);
$accion = htmlentities($_GET['accion']);

$update = $conexion->prepare("UPDATE inventario SET estatus_inv = ? WHERE propiedad_inv = ?");
$update->bind_param('ss',$accion,$id);

if ($update->execute())
{
  header('location:../extend/alerta.php?msj=INMUEBLE '.$accion.'&c=prop&p=in&t=success');
}
else
{
  header('location:../extend/alerta.php?msj=INMUEBLE NO CANCELADO&c=prop&p=in&t=error');
}
$update->close();
$conexion->close();

?>
