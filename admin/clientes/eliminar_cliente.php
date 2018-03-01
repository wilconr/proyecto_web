<?php
include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);

$delete = $conexion->prepare("DELETE FROM clientes WHERE id_cliente = ?");
$delete->bind_param('i',$id);

if ($delete->execute())
{
  header('location:../extend/alerta.php?msj=Cliente eliminado&c=cli&p=in&t=success');
}
else
{
  header('location:../extend/alerta.php?msj=El cliente no pudo ser eliminado&c=cli&p=in&t=error');
}

$delete->close();
$conexion->close();

?>
