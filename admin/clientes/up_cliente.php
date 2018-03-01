<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $nombre = htmlentities($_POST['nombre']);
  $direccion = htmlentities($_POST['direccion']);
  $telefono = htmlentities($_POST['telefono']);
  $correo = htmlentities($_POST['correo']);
  $id = htmlentities($_POST['id']);

  $update = $conexion->prepare("UPDATE clientes SET nombre_cliente = ?, dir_cliente = ?, tel_cliente = ?, correo_cliente = ? WHERE id_cliente = ?");
  $update->bind_param('ssssi', $nombre, $direccion, $telefono, $correo, $id);

  if ($update->execute())
  {
    $updateInv = $conexion->prepare("UPDATE inventario SET nombre_cliente = ? WHERE id_clientes = ?");
    $updateInv->bind_param('si',$nombre,$id);
    $updateInv->execute();
    $updateInv->close();
    header('location:../extend/alerta.php?msj=Cliente actualizado&c=cli&p=in&t=success');
  }
  else
  {
    header('location:../extend/alerta.php?msj=El cliente no pudo ser actualizado&c=cli&p=in&t=error');
  }
  $update->close();
  $conexion->close();
}
else
{
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cli&p=in&t=error');
}
?>
