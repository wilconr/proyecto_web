<?php
include '../conexion/conexion.php';

$id = htmlentities($_GET['id']);
$ruta = htmlentities($_GET['ruta']);

$delete = $conexion->prepare("DELETE FROM slider WHERE id_slider = ?");
$delete->bind_param('i',$id);

if ($delete->execute())
{
  unlink($ruta);
  header('location:../extend/alerta.php?msj=Imagen borrada&c=home&p=sl&t=success');
}
else
{
  header('location:../extend/alerta.php?msj=Imagen no puedo ser borrada&c=home&p=sl&t=error');
}

$delete->close();
$conexion->close();
?>
