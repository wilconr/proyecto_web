<?php
include '../conexion/conexion.php';

$id = htmlentities($_GET['id']);
$ruta = htmlentities($_GET['ruta']);
$id_propiedad = htmlentities($_GET['id_propiedad']);

$delete = $conexion->prepare("DELETE FROM imagenes WHERE id_img = ?");
$delete->bind_param('i',$id);

if ($delete->execute())
{
  unlink($ruta);
  header('location:../extend/alerta.php?msj=Imagen borrada&c=prop&p=img&t=success&id='.$id_propiedad.'');
}
else
{
  header('location:../extend/alerta.php?msj=Imagen no puedo ser borrada&c=prop&p=img&t=error&id='.$id_propiedad.'');
}

$delete->close();
$conexion->close();
?>
