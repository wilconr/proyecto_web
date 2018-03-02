<?php
include '../conexion/conexion.php';

$id = htmlentities($_GET['id']);
$marcado = htmlentities($_GET['marcado']);

$update = $conexion->prepare("UPDATE inventario SET marcado_inv = ? WHERE propiedad_inv = ?");
$update->bind_param('ss',$marcado,$id);

if ($marcado == '')
{
  $marc = 'desmarcado';
}
else
{
  $marc = 'marcado';
}

if ($update->execute())
{
  header('location:../extend/alerta.php?msj=Inmueble '.$marc.' &c=prop&p=in&t=success');
}
else
{
  header('location:../extend/alerta.php?msj=El inmueble no se puedo marcar&c=prop&p=in&t=error');
}
$update->close();
$conexion->close();
?>
