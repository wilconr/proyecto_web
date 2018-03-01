<?php
include '../conexion/conexion.php';
$id = $conexion->real_escape_string(htmlentities($_GET['us']));
$bloqueo = $conexion->real_escape_string(htmlentities($_GET['bl']));

if ($bloqueo == 1)
{
  $update = $conexion->query("UPDATE usuarios SET bloqueo_usuario=0 WHERE id_usuario='$id'");
  if ($update)
  {
    header('location:../extend/alerta.php?msj=El usuario ha sido bloqueado&c=us&p=in&t=success');
  }
  else
  {
    header('location:../extend/alerta.php?msj=El usuario ha podido ser bloqueado&c=us&p=in&t=error');
  }
}
else
{
  $update = $conexion->query("UPDATE usuarios SET bloqueo_usuario=1 WHERE id_usuario='$id'");
  if ($update)
  {
    header('location:../extend/alerta.php?msj=El usuario ha sido desbloqueado&c=us&p=in&t=success');
  }
  else
  {
    header('location:../extend/alerta.php?msj=El usuario ha podido ser desbloqueado&c=us&p=in&t=error');
  }
}

?>
