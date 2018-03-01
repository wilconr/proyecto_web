<?php
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $id = htmlentities($_POST['id']);
  $foto = htmlentities($_POST['anterior']);
  $ruta = $_FILES['foto']['tmp_name'];
  $imagen = $_FILES['foto']['name'];

  $ancho = 500;
  $alto = 400;
  $info = pathinfo($imagen);
  $tamaño = getimagesize($ruta);
  $width = $tamaño[0];
  $heigth = $tamaño[1];

  if ($info['extension'] == 'jpg' || $info['extension'] == 'JPG')
  {
    $imagenVieja = imagecreatefromjpeg($ruta);
    $nueva = imagecreatetruecolor($ancho,$alto);
    imagecopyresampled($nueva, $imagenVieja, 0, 0, 0, 0, $ancho, $alto, $width, $heigth);
    $rand = rand(000,999);
    $copia = 'casas/principal_'.$rand.$id.'.jpg';
    imagejpeg($nueva, $copia);
  }
  elseif ($info['extension'] == 'jpeg' || $info['extension'] == 'JPEG')
  {
    $imagenVieja = imagecreatefromjpeg($ruta);
    $nueva = imagecreatetruecolor($ancho,$alto);
    imagecopyresampled($nueva, $imagenVieja, 0, 0, 0, 0, $ancho, $alto, $width, $heigth);
    $rand = rand(000,999);
    $copia = 'casas/principal_'.$rand.$id.'.jpeg';
    imagejpeg($nueva, $copia);
  }
  elseif ($info['extension'] == 'png' || $info['extension'] == 'PNG')
  {
    $imagenVieja = imagecreatefrompng($ruta);
    $nueva = imagecreatetruecolor($ancho,$alto);
    imagecopyresampled($nueva, $imagenVieja, 0, 0, 0, 0, $ancho, $alto, $width, $heigth);
    $rand = rand(000,999);
    $copia = 'casas/principal_'.$rand.$id.'.png';
    imagepng($nueva, $copia);
  }
  else
  {
    header('location:../extend/alerta.php?msj=Solo se aceptan formatos JPG y PNG&c=prop&p=img&t=error&id='.$id.'');
    exit;
  }

  $update = $conexion->prepare("UPDATE inventario SET foto_principal_inv = ? WHERE propiedad_inv = ?");
  $update->bind_param('ss',$copia, $id);

  if ($update->execute())
  {
    if ($foto != 'casas/foto_principal.png') {
      unlink($foto);
    }
    header('location:../extend/alerta.php?msj=Foto principal actualizada&c=prop&p=img&t=success&id='.$id.'');
  }
  else
  {
    header('location:../extend/alerta.php?msj=La foto principal no pudo ser actualizadada&c=prop&p=img&t=error&id='.$id.'');
  }

  $update->close();
  $conexion->close();
}
else
{
  $id = htmlentities($_POST['id']);
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=prop&p=img&t=error&id='.$id.'');
}

?>
