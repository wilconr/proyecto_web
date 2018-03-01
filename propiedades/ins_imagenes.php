<?php
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $id = htmlentities($_POST['id']);
  $contador = 0;
  foreach ($_FILES['ruta']['tmp_name'] as $key => $value)
  {
    $ruta = $_FILES['ruta']['tmp_name'][$key];
    $imagen = $_FILES['ruta']['name'][$key];

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
      $contador++;
      $rand = rand(000,999);
      $renombrar = $id.$rand.$contador;
      $copia = 'casas/'.$renombrar.'.jpg';
      imagejpeg($nueva, $copia);
    }
    elseif ($info['extension'] == 'jpeg' || $info['extension'] == 'JPEG')
    {
      $imagenVieja = imagecreatefromjpeg($ruta);
      $nueva = imagecreatetruecolor($ancho,$alto);
      imagecopyresampled($nueva, $imagenVieja, 0, 0, 0, 0, $ancho, $alto, $width, $heigth);
      $contador++;
      $rand = rand(000,999);
      $renombrar = $id.$rand.$contador;
      $copia = 'casas/'.$renombrar.'.jpeg';
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
      $copia = 'casas/'.$renombrar.'.png';
      imagepng($nueva, $copia);
    }
    else
    {
      header('location:../extend/alerta.php?msj=Solo se aceptan formatos JPG y PNG&c=prop&p=img&t=error&id='.$id.'');
      exit;
    }

    $insert = $conexion->prepare("INSERT INTO imagenes VALUES (?,?,?)");
    $insert->bind_param('iss',$idImg, $id, $copia);
    $idImg = '';
    $insert->execute();

  }

  if ($insert)
  {
    header('location:../extend/alerta.php?msj=Imagenes guardadas&c=prop&p=img&t=success&id='.$id.'');
  }
  else
  {
    header('location:../extend/alerta.php?msj=Las imagenes no han podido ser guardadas&c=prop&p=img&t=error&id='.$id.'');
  }

  $insert->close();
  $conexion->close();
}
else
{
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=prop&p=img&t=error&id='.$id.'');
}

?>
