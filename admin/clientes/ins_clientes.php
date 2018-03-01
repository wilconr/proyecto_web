<?php
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $id = '';
  $nombre = htmlentities($_POST['nombre']);
  $direccion = htmlentities($_POST['direccion']);
  $telefono = htmlentities($_POST['telefono']);
  $correo = htmlentities($_POST['correo']);
  $asesor = $_SESSION['nombre'];

  $insert = $conexion->prepare("INSERT INTO clientes VALUES (?,?,?,?,?,?)");
  $insert->bind_param('isssss', $id, $nombre, $direccion, $telefono, $correo, $asesor);
  if ($insert->execute())
  {
    header('location:../extend/alerta.php?msj=Cliente registrado&c=cli&p=in&t=success');
  }
  else
  {
    header('location:../extend/alerta.php?msj=El cliente no pudo ser registrado&c=cli&p=in&t=error');
  }
  $insert->close();
  $conexion->close();
}
else
{
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cli&p=in&t=error');
}

?>
