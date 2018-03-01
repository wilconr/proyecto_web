<?php

include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $nick = $_SESSION['nick'];
  $nombre = $conexion->real_escape_string(htmlentities($_POST['nombre']));
  $correo = $conexion->real_escape_string(htmlentities($_POST['correo']));

  $update = $conexion->query("UPDATE usuarios SET nombre_usuario = '$nombre',correo_usuario = '$correo' WHERE nick_usuario='$nick'");

  if ($update)
  {
    $_SESSION['nombre'] = $nombre;
    $_SESSION['correo'] = $correo;
    header('location:../extend/alerta.php?msj=Datos actualizados&c=pe&p=perfil&t=success');
  }
  else
  {
    header('location:../extend/alerta.php?msj=Los datos no actualizados&c=pe&p=perfil&t=error');
  }

  $conexion->close();
}
else
{
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=pe&p=perfil&t=error');
}

?>
