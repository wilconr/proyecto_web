<?php

include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  $user = $conexion->real_escape_string(htmlentities($_POST['usuario']));
  $clave = $conexion->real_escape_string(htmlentities($_POST['clave']));
  $candado = ' ';
  $str_u = strpos($user,$candado);
  $str_c = strpos($clave,$candado);

  if (is_int($str_u))
  {
    $user = '';
  }
  else
  {
    $usuario = $user;
  }

  if (is_int($str_c))
  {
    $clave = '';
  }
  else
  {
    $clave2 = sha1($clave);
  }

  if ($user == null && $clave == null)
  {
    header('location:../extend/alerta.php?msj=El formato de la contraseña no es correcto&c=salir&p=salir&t=error');
  }
  else
  {
    $select = $conexion->query("SELECT nick_usuario,clave_usuario,nombre_usuario,correo_usuario,nivel_usuario,foto_usuario FROM usuarios WHERE nick_usuario = '$usuario' AND clave_usuario = '$clave2' AND bloqueo_usuario = 1");
    $row = mysqli_num_rows($select);
    if ($row == 1)
    {
      if ($var = $select->fetch_assoc()) {
        $nick = $var['nick_usuario'];
        $clave = $var['clave_usuario'];
        $nombre = $var['nombre_usuario'];
        $correo = $var['correo_usuario'];
        $nivel = $var['nivel_usuario'];
        $foto = $var['foto_usuario'];
      }
      if ($nick == $usuario && $clave == $clave2 && $nivel == 'ADMINISTRADOR')
      {
        $_SESSION['nick'] = $nick;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['correo'] = $correo;
        $_SESSION['nivel'] = $nivel;
        $_SESSION['foto'] = $foto;
        header('location:../extend/alerta.php?msj=Bienvenido&c=home&p=home&t=success');
      }
      elseif ($nick == $usuario && $clave == $clave2 && $nivel == 'ASESOR')
      {
        $_SESSION['nick'] = $nick;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['correo'] = $correo;
        $_SESSION['nivel'] = $nivel;
        $_SESSION['foto'] = $foto;
        header('location:../extend/alerta.php?msj=Bienvenido&c=home&p=home&t=success');
      }
      else
      {
        header('location:../extend/alerta.php?msj=No tienes permiso para acceder&c=salir&p=salir&t=error');
      }
    }
    else
    {
      header('location:../extend/alerta.php?msj=Nombre de usuario o clave incorrectos&c=salir&p=salir&t=error');
    }
  }
}
else
{
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=salir&p=salir&t=error');
}
$conexion->close();
?>
