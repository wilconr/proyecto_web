<?php

include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $nick = $_SESSION['nick'];
  $clave = $conexion->real_escape_string(htmlentities($_POST['clave1']));
  $clave = sha1($clave);

  $update = $conexion->query("UPDATE usuarios SET clave_usuario = '$clave' WHERE nick_usuario='$nick'");

  if ($update)
  {
    header('location:../extend/alerta.php?msj=Clave actualizada&c=pe&p=perfil&t=success');
  }
  else
  {
    header('location:../extend/alerta.php?msj=La clave no pudo ser actualizada&c=pe&p=perfil&t=error');
  }

  $conexion->close();
}
else
{
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=pe&p=perfil&t=error');
}

?>
