<?php
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $contador = 0;
  foreach ($_FILES['ruta']['tmp_name'] as $key => $value)
  {
    $ruta = $_FILES['ruta']['tmp_name'][$key];
    $imagen = $_FILES['ruta']['name'][$key];

    $ancho = 1080;
    $alto = 250;
    $info = pathinfo($imagen);
    $tamaño = getimagesize($ruta);
    $width = $tamaño[0];
    $heigth = $tamaño[1];

    if ($info['extension'] == 'jpg' || $info['extension'] == 'JPG')
    {
      $imagenVieja = imagecreatefromjpeg($ruta);
      $nueva = imagecreatetruecolor($ancho,$alto);
      imagecopyresampled($nueva, $imagenVieja, 0, 0, 0, 0, $ancho, $alto, $width, $heigth);
      $contador++;
      $rand = rand(000,999);
      $renombrar = $rand.$contador;
      $copia = 'slider/'.$renombrar.'.jpg';
      imagejpeg($nueva, $copia);
    }
    elseif ($info['extension'] == 'jpeg' || $info['extension'] == 'JPEG')
    {
      $imagenVieja = imagecreatefromjpeg($ruta);
      $nueva = imagecreatetruecolor($ancho,$alto);
      imagecopyresampled($nueva, $imagenVieja, 0, 0, 0, 0, $ancho, $alto, $width, $heigth);
      $contador++;
      $rand = rand(000,999);
      $renombrar = $rand.$contador;
      $copia = 'slider/'.$renombrar.'.jpeg';
      imagejpeg($nueva, $copia);
    }
    elseif ($info['extension'] == 'png' || $info['extension'] == 'PNG')
    {
      $imagenVieja = imagecreatefrompng($ruta);
      $nueva = imagecreatetruecolor($ancho,$alto);
      imagecopyresampled($nueva, $imagenVieja, 0, 0, 0, 0, $ancho, $alto, $width, $heigth);
      $contador++;
      $rand = rand(000,999);
      $renombrar = $id.$rand.$contador;
      $copia = 'slider/'.$renombrar.'.png';
      imagepng($nueva, $copia);
    }
    else
    {
      header('location:../extend/alerta.php?msj=Solo se aceptan formatos JPG y PNG&c=home&p=sl&t=error');
      exit;
    }

    $insert = $conexion->prepare("INSERT INTO slider VALUES (?,?)");
    $insert->bind_param('is',$idImg, $copia);
    $idImg = '';
    $insert->execute();

  }

  if ($insert)
  {
    header('location:../extend/alerta.php?msj=Imagenes guardadas&c=home&p=sl&t=success');
  }
  else
  {
    header('location:../extend/alerta.php?msj=Las imagenes no han podido ser guardadas&c=home&p=sl&t=error');
  }

  $insert->close();
  $conexion->close();
}
else
{
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=home&p=sl&t=error');
}

?>
