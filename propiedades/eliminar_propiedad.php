<?php

include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);
$foto = htmlentities($_GET['foto']);


  $delete = $conexion->prepare("DELETE FROM inventario WHERE propiedad_inv = ?");
  $delete->bind_param('s',$id);

  if ($delete->execute())
  {
    unlink($foto);
    $select = $conexion->prepare("SELECT * FROM imagenes WHERE id_propiedad = ?");
    $select->bind_param('s',$id);
    $select->execute();
    $resultado = $select->get_result();

    while ($f= $resultado->fetch_assoc())
    {
      unlink($f['ruta_img']);
    }

    $deleteImg = $conexion->prepare("DELETE FROM imagenes WHERE id_propiedad = ?");
    $deleteImg->bind_param('s',$id);
    $deleteImg->execute();
    $deleteImg->close();

    header('location:../extend/alerta.php?msj=Propiedad eliminada&c=prop&p=can&t=success');

  }
  else
  {
    header('location:../extend/alerta.php?msj=Propiedad no pudo ser eliminada&c=prop&p=can&t=error');
  }

  $delete->close();
  $conexion->close();

?>
